<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Audio;
use App\Models\Collection;
use Google\Cloud\TextToSpeech\V1\AudioEncoding;
use Google\Cloud\TextToSpeech\V1\SsmlVoiceGender;
use Google\Cloud\TextToSpeech\V1\SynthesizeSpeechRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

use Google\Cloud\TextToSpeech\V1\Client\TextToSpeechClient;

use Google\Cloud\TextToSpeech\V1\SynthesisInput;
use Google\Cloud\TextToSpeech\V1\VoiceSelectionParams;
use Google\Cloud\TextToSpeech\V1\AudioConfig;
use Illuminate\Support\Facades\Storage;


class AudioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
   public function index(Request $request)
    {
        $query = Audio::with('collection');
        session(['redirect_url' => url()->full()]);
        // Handle search
        if ($request->filled('search')) {
            $search = $request->search;
            $query->whereHas('collection', function ($q) use ($search) {
                $q->where('nomer_reg', 'like', "%{$search}%")
                ->orWhere('judul_tugas_akhir', 'like', "%{$search}%");
            });
        }

        // Handle sorting
        switch ($request->sort) {
            case 'terbaru':
                $query->orderBy('created_at', 'desc');
                break;
            case 'terlama':
                $query->orderBy('created_at', 'asc');
                break;
            case 'judul_asc':
                $query->join('collections', 'audios.collection_id', '=', 'collections.id')
                    ->orderBy('collections.judul_tugas_akhir', 'asc')
                    ->select('audios.*');  // important to avoid column conflict
                break;
            case 'judul_desc':
                $query->join('collections', 'audios.collection_id', '=', 'collections.id')
                    ->orderBy('collections.judul_tugas_akhir', 'desc')
                    ->select('audios.*');
                break;
            case 'bahasa_asc':
                $query->orderBy('bahasa', 'asc');
                break;
            case 'bahasa_desc':
                $query->orderBy('bahasa', 'desc');
                break;
            case 'durasi_asc':
                $query->orderBy('durasi', 'asc');
                break;
            case 'durasi_desc':
                $query->orderBy('durasi', 'desc');
                break;
            case 'format_asc':
                $query->orderBy('format', 'asc');
                break;
            case 'format_desc':
                $query->orderBy('format', 'desc');
                break;
            case 'tanggal_dibuat_asc':
                $query->orderBy('created_at', 'asc');
                break;
            case 'tanggal_dibuat_desc':
                $query->orderBy('created_at', 'desc');
                break;
            default:
                $query->orderBy('created_at', 'desc');
                break;
        }

        // Paginate with query params preserved
        $audios = $query->paginate(5)->appends($request->except('page'));

        $title = "Data Audio";

        return view('admin.audio.index', compact('audios', 'title'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

    }

    public function createByKoleksi(Request $request, $collectionId)
    {
        $language = $request->query('language');  // language stays as query

        $collection = Collection::findOrFail($collectionId);
        $title = 'Admin - Create Audio';

        return view('admin.audio.create', compact('title', 'collection', 'language'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
      
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
       
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Find the audio to delete
        $audio = Audio::findOrFail($id);

        // Get the collection ID before deleting the audio
        $collectionId = $audio->collection_id;

        try {
            // ✅ Delete the audio file from storage if it exists
            if ($audio->base64 && Storage::disk('public')->exists($audio->base64)) {
                Storage::disk('public')->delete($audio->base64);
            }

            // ✅ Delete the audio record from DB
            $audio->delete();

            // ✅ Check if collection should be marked 'Belum Tersedia'
            $audioCount = Audio::where('collection_id', $collectionId)->count();

            if ($audioCount === 0) {
                $collection = Collection::find($collectionId);
                if ($collection) {
                    $collection->status = 'Belum Tersedia';
                    $collection->save();
                }
            }

        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal menghapus audio. ' . $e->getMessage());
        }

        // Redirect to previous or default page
        $redirect = session()->pull('redirect_url', route('admin.audio.index'));

        return redirect($redirect)->with('success', 'Audio berhasil dihapus.');
    }


    public function testTTS(Request $request)
    {

        $request->validate([
            'input.text' => 'required|string',
            'voice.languageCode' => 'required|string',
            'voice.name' => 'required|string',
            'voice.ssmlGender' => 'required|string',
            'audioConfig.audioEncoding' => 'required|string',
            'audioConfig.speakingRate' => 'nullable|numeric',
            'audioConfig.pitch' => 'nullable|numeric',
        ]);

        $keyFilePath = public_path('images/credentials-tts.json');

        $client = new TextToSpeechClient([
            'credentials' => $keyFilePath,
        ]);

        try {
            $inputText = $request->input('input.text');

            $input = (new SynthesisInput())->setText($inputText);

            $voice = (new VoiceSelectionParams())
                ->setLanguageCode($request->input('voice.languageCode'))
                ->setName($request->input('voice.name'))
                ->setSsmlGender(constant(SsmlVoiceGender::class . '::' . strtoupper($request->input('voice.ssmlGender'))));

            $audioConfig = (new AudioConfig())
                ->setAudioEncoding(constant(AudioEncoding::class . '::' . strtoupper($request->input('audioConfig.audioEncoding'))))
                ->setSpeakingRate($request->input('audioConfig.speakingRate', 1.0))
                ->setPitch($request->input('audioConfig.pitch', 0.0));

            $requestObject = (new SynthesizeSpeechRequest())
                ->setInput($input)
                ->setVoice($voice)
                ->setAudioConfig($audioConfig);

            $response = $client->synthesizeSpeech($requestObject);

            $audioContent = $response->getAudioContent();

            return response()->json([
                'audioContent' => base64_encode($audioContent),
            ]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'TTS Error: ' . $e->getMessage()], 500);
        } finally {
            $client->close();
        }
    }

    public function storeByKoleksi($collectionId, Request $request)
    {
        $validated = $request->validate([
            'bahasa'         => 'required|string|max:10',
            'durasi'         => 'nullable|string|max:10',
            'format'         => 'required|string|max:20',
            'base64'         => 'required|string', // still required
            'pitch'          => 'required|numeric',
            'speaking_rate'  => 'required|numeric',
            'tipe_suara'     => 'nullable|string|max:50',
        ]);

        try {
            $collection = Collection::findOrFail($collectionId);

            // Prevent duplicate
            $existingAudio = Audio::where('collection_id', $collectionId)
                ->where('bahasa', $validated['bahasa'])
                ->first();

            if ($existingAudio) {
                return redirect()
                    ->back()
                    ->withErrors(['error' => 'Audio dengan bahasa ' . $validated['bahasa'] . ' sudah ada untuk koleksi ini.']);
            }

            // Decode base64 audio and store file
            $audioData = base64_decode(preg_replace('/^data:audio\/\w+;base64,/', '', $validated['base64']));

            // 🧠 Determine correct file extension
            $extension = strtolower($validated['format']) === 'linear16' ? 'wav' : strtolower($validated['format']);

            // 🧾 Generate unique filename with proper extension
            $fileName = 'audio_' . uniqid() . '.' . $extension;

            // 📁 Build relative path in storage/app/public/audios/
            $filePath = 'audios/' . $fileName;

            // 💾 Save decoded audio to public disk
            Storage::disk('public')->put($filePath, $audioData);

            // ✅ Save the file path to the database instead of base64
            $validated['file_path'] = $filePath;
            unset($validated['base64']); // remove large payload


            // 💡 Overwrite base64 field to now contain file path
            $validated['base64'] = $filePath;

            $validated['collection_id'] = $collection->id;

            // Save to DB
            Audio::create($validated);

            // Update collection status
            if ($collection->status !== 'Tersedia') {
                $collection->status = 'Tersedia';
                $collection->save();
            }

            return redirect()
                ->route('admin.audio.index')
                ->with('success', 'Audio berhasil disimpan dan status koleksi diperbarui.');

        } catch (\Exception $e) {
            \Log::error('Gagal menyimpan audio', ['error_message' => $e->getMessage()]);
            return redirect()
                ->back()
                ->withErrors(['error' => 'Terjadi kesalahan saat menyimpan audio.']);
        }
    }
}
