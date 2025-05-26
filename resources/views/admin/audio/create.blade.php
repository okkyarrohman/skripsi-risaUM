@extends('layouts.admin.app')

@section('title', $title)

@section('content')
<div class="max-w-6xl mx-auto py-8">
    <h2 class="text-2xl font-bold">
        Text to speech
    </h2>
    <p class="text-sm text-gray-500 mb-2">
        {{ $collection->judul_tugas_akhir }} - {{ $collection->nama_penulis }}
    </p>

    <div class="bg-white shadow-md rounded-lg p-8">
        @if ($errors->any())
            <div class="mb-6 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
                <strong>Errors occurred:</strong>
                <ul class="list-disc list-inside mt-2">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.audio.store', ['collection' => $collection->id]) }}" method="POST" class="space-y-6" enctype="multipart/form-data" id="ttsForm">
            @csrf

            {{-- Abstrak --}}
            <div>
                <label for="abstrak" class="font-medium mb-2 block">
                    {{ $language == 'id' ? 'Abstrak Bahasa Indonesia' : 'Abstrak English' }}
                </label>
                @php
                    $abstrakText = old('abstrak') ?? ($language == 'id' ? $collection->abstrak_indo : $collection->abstrak_eng);
                @endphp
                <textarea
                    id="abstrak"
                    name="abstrak"
                    rows="5"
                    class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 bg-gray-100"
                    readonly
                >{{ $abstrakText }}</textarea>

                <div class="text-sm text-gray-500 mt-2 text-right">
                    {{ strlen($abstrakText) }} karakter
                </div>
            </div>

            {{-- Cards --}}
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

                {{-- Left column: Voice Option + Output Format --}}
                <div class="space-y-6 md:col-span-2">

                    {{-- Voice Option --}}
                    <div class="bg-white rounded-lg shadow p-6 space-y-4">
                        <h3 class="font-semibold mb-2">Voice Option</h3>

                        <div>
                            <label for="language" class="block text-sm font-medium text-gray-700 mb-1">Language</label>
                            <input
                                type="text"
                                id="language"
                                value="{{ $language == 'id' ? 'Indonesia' : ($language == 'en' ? 'English' : 'Unknown') }}"
                                readonly
                                class="w-full border border-gray-300 rounded px-3 py-2 bg-gray-100 cursor-not-allowed"
                            >
                        </div>

                        <div>
                            <label for="voice" class="block text-sm font-medium text-gray-700 mb-1">Suara</label>
                            <select
                                name="voice"
                                id="voice"
                                class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                            >
                            @if ($language == 'id')
                                <option value="FEMALE" data-voice='{"languageCode":"id-ID","name":"id-ID-Standard-A","ssmlGender":"FEMALE"}'>Female</option>
                                <option value="MALE" data-voice='{"languageCode":"id-ID","name":"id-ID-Standard-B","ssmlGender":"MALE"}'>Male</option>
                            @elseif ($language == 'en')
                                <option value="MALE" data-voice='{"languageCode":"en-US","name":"en-US-Standard-A","ssmlGender":"MALE"}'>Male</option>
                                <option value="FEMALE" data-voice='{"languageCode":"en-US","name":"en-US-Standard-C","ssmlGender":"FEMALE"}'>Female</option>
                            @endif
                            </select>
                        </div>
                    </div>

                    {{-- Output Format --}}
                    <div class="bg-white rounded-lg shadow p-6">
                        <h3 class="font-semibold mb-2">Output Format</h3>

                        <select name="output_format" id="output_format" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <option value="MP3" {{ ($collection->output_format ?? '') === 'MP3' ? 'selected' : '' }}>MP3</option>
                            <option value="LINEAR16" {{ ($collection->output_format ?? '') === 'LINEAR16' ? 'selected' : '' }}>WAV</option>
                        </select>
                    </div>
                </div>

                {{-- Right column: Audio Settings --}}
                <div class="bg-white rounded-lg shadow p-6 space-y-6">
                    <h3 class="font-semibold mb-4 text-lg">Audio Settings</h3>

                    <div>
                        <label for="speakingRate" class="block font-semibold mb-2">
                            Speaking Rate:
                            <span id="speakingRateValue" class="text-blue-600 font-medium">
                                {{ old('speakingRate', $collection->speakingRate ?? 1.0) }}
                            </span>
                        </label>
                        <input
                            type="range"
                            step="0.01"
                            min="0.25"
                            max="4.0"
                            name="speakingRate"
                            id="speakingRate"
                            value="{{ old('speakingRate', $collection->speakingRate ?? 1.0) }}"
                            class="w-full h-3 rounded-lg bg-gradient-to-r from-blue-400 to-blue-600 cursor-pointer accent-blue-600 focus:outline-none"
                        >
                    </div>

                    <div>
                        <label for="pitch" class="block font-semibold mb-2">
                            Pitch:
                            <span id="pitchValue" class="text-blue-600 font-medium">
                                {{ old('pitch', $collection->pitch ?? 0.0) }}
                            </span>
                        </label>
                        <input
                            type="range"
                            step="0.1"
                            min="-20.0"
                            max="20.0"
                            name="pitch"
                            id="pitch"
                            value="{{ old('pitch', $collection->pitch ?? 0.0) }}"
                            class="w-full h-3 rounded-lg bg-gradient-to-r from-blue-400 to-blue-600 cursor-pointer accent-blue-600 focus:outline-none"
                        >
                    </div>

                    <!-- Test Audio button here -->
                    <div>
                        <button type="button" id="testAudioBtn" class="w-full bg-green-600 text-white px-4 py-2 rounded hover:bg-green-800 cursor-pointer">
                            Test Audio
                        </button>
                    </div>
                </div>


            </div>

            {{-- Buttons below --}}
            <div class="flex justify-end space-x-4 pt-6">
                <a href="{{ route('admin.audio.index', ['collection' => $collection->id]) }}" class="px-6 py-2 border rounded border-gray-400 hover:bg-gray-100">Cancel</a>
                <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-800 cursor-pointer">Add Audio</button>
            </div>
        </form>
    </div>
</div>

<script>
    // Voice select change console log
    document.getElementById('voice').addEventListener('change', function() {
        const selectedOption = this.options[this.selectedIndex];
        const voiceJson = selectedOption.getAttribute('data-voice');
        const voiceObj = JSON.parse(voiceJson);
    });

    // Log initial voice selection on page load
    window.addEventListener('DOMContentLoaded', () => {
        const select = document.getElementById('voice');
        const selectedOption = select.options[select.selectedIndex];
        const voiceJson = selectedOption.getAttribute('data-voice');
        const voiceObj = JSON.parse(voiceJson);
        console.log({ voice: voiceObj });
    });

    // Update speaking rate and pitch display values
    const speakingRateSlider = document.getElementById('speakingRate');
    const speakingRateValue = document.getElementById('speakingRateValue');
    const pitchSlider = document.getElementById('pitch');
    const pitchValue = document.getElementById('pitchValue');

    speakingRateSlider.addEventListener('input', () => {
        speakingRateValue.textContent = speakingRateSlider.value;
    });

    pitchSlider.addEventListener('input', () => {
        pitchValue.textContent = pitchSlider.value;
    });

    // Test Audio button click event
    document.getElementById('testAudioBtn').addEventListener('click', async () => {
        const abstrakText = document.getElementById('abstrak').value.trim();
        const voiceSelect = document.getElementById('voice');
        const selectedVoiceOption = voiceSelect.options[voiceSelect.selectedIndex];
        const voiceData = JSON.parse(selectedVoiceOption.getAttribute('data-voice'));
        const outputFormat = document.getElementById('output_format').value;
        const speakingRate = parseFloat(document.getElementById('speakingRate').value);
        const pitch = parseFloat(document.getElementById('pitch').value);

        const audioTestPayload = {
            input: { text: abstrakText },
            voice: voiceData,
            audioConfig: {
                audioEncoding: outputFormat,
                speakingRate: speakingRate,
                pitch: pitch
            }
        };

        try {
            const response = await fetch("{{ route('admin.audio.testTTS') }}", {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify(audioTestPayload)
            });

            if (!response.ok) throw new Error('Backend error: ' + response.statusText);

            const data = await response.json();

            if (data.audioContent) {
                const audio = new Audio(`data:audio/mp3;base64,${data.audioContent}`);
                audio.play();
            } else {
                alert('No audio received from backend');
            }
        } catch (error) {
            console.error('Error:', error);
            alert('Failed to get audio from backend');
        }
    });
</script>
@endsection
