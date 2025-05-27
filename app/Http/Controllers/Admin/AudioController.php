<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
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


class AudioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = "Admin - Data Audio";
        return view('admin.audio.index', compact('title'));
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

        return view('admin.audio.by.koleksi.create', compact('title', 'collection', 'language'));
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
    public function destroy($id)
    {
        
    }

    public function testTTS(Request $request)
    {
        Log::info('testTTS called', ['request_data' => $request->all()]);

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
        Log::info('Using credentials file', ['path' => $keyFilePath]);

        $client = new TextToSpeechClient([
            'credentials' => $keyFilePath,
        ]);

        try {
            $inputText = $request->input('input.text');
            Log::info('Synthesizing speech for text', ['text' => $inputText]);

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
            Log::info('Received audio content', ['length' => strlen($audioContent)]);

            return response()->json([
                'audioContent' => base64_encode($audioContent),
            ]);
        } catch (\Exception $e) {
            Log::error('TTS Error', ['message' => $e->getMessage()]);
            return response()->json(['error' => 'TTS Error: ' . $e->getMessage()], 500);
        } finally {
            $client->close();
            Log::info('TextToSpeechClient closed');
        }
    }

}
