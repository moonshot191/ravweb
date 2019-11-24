
@extends('layouts.app', ['activePage' => 'zalmoxis-management', 'titlePage' => __('Zalmoxis Management')])
<style type="text/css">

    .final {
        color: black;
        padding-right: 3px;
    }
    .interim {
        color: gray;
    }
    .info {
        font-size: 14px;
        text-align: center;
        color: #777;
        display: none;
    }

    #info {

        text-align: center;
        color: red;
        visibility: hidden;
    }
    #results {
        font-size: 14px;
        font-weight: bold;
        border: 1px solid rgba(72, 98, 110, 0.37);
        padding: 15px;
        text-align: left;
        max-height: 50px;
    }
    #start_button {
        border: 0;
        background-color:red;
        padding: 0;
    }
    canvas{
        display: block;
    }

    .button{
        display: inline-block;
        vertical-align: middle;
        margin: 0px 5px;
        padding: 5px 12px;
        cursor: pointer;
        outline: none;
        font-size: 13px;
        text-decoration: none !important;
        text-align: center;
        color:#fff;
        background-color: #4D90FE;
        background-image: linear-gradient(top,#4D90FE, #4787ED);
        background-image: -ms-linear-gradient(top,#4D90FE, #4787ED);
        background-image: -o-linear-gradient(top,#4D90FE, #4787ED);
        background-image: linear-gradient(top,#4D90FE, #4787ED);
        border: 1px solid #4787ED;
        box-shadow: 0 1px 3px #BFBFBF;
    }
    a.button{
        color: #fff;
    }
    .button:hover{
        box-shadow: inset 0px 1px 1px #8C8C8C;
    }
    .button.disabled{
        box-shadow:none;
        opacity:0.7;
    }
</style>
@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <form id="myForm" >
                        <div class="card ">
                            <div class="card-header card-header-primary">
                                <h4 class="card-title">{{ __('Add Zalmoxis Question') }}</h4>
                                <p class="card-category"></p>
                            </div>
                            <div class="card-body ">
                                <div class="alert alert-danger display-error" style="display: none"></div>
                                @if (session('status'))
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="alert alert-danger">
                                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                    <i class="material-icons">close</i>
                                                </button>
                                                <span>{{ session('status') }}</span>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                                <div class="row">
                                    <div class="col-md-12 text-right">
                                        <a href="{{ route('zalmox.index') }}" class="btn btn-sm btn-primary">{{ __('Back to list') }}</a>
                                    </div>
                                </div>
                                 <div class="row" id="info">
                                        <ul id="info_start">
                                            <li class="text-left">Use earphones for the best results.</li>
                                            <li class="text-left">Click on the microphone icon and begin speaking.</li>
                                            <li class="text-left">Click on the record button when ready to record.</li>

                                            </ul>

                                        <p id="info_speak_now">Speak now.</p>
                                        <p id="info_no_speech">No speech was detected. You may need to adjust your
                                            <a href="//support.google.com/chrome/bin/answer.py?hl=en&amp;answer=1407892">
                                                microphone settings</a>.</p>
                                        <p id="info_no_microphone" style="display:none">
                                            No microphone was found. Ensure that a microphone is installed and that
                                            <a href="//support.google.com/chrome/bin/answer.py?hl=en&amp;answer=1407892">
                                                microphone settings</a> are configured correctly.</p>
                                        <p id="info_allow">Click the "Allow" button above to enable your microphone.</p>
                                        <p id="info_denied">Permission to use microphone was denied.</p>
                                        <p id="info_blocked">Permission to use microphone is blocked. To change,
                                            go to <a target="_blank" href="chrome://settings">chrome://settings</a></p>
                                        <p id="info_upgrade">Web Speech API is not supported by this browser.
                                            Upgrade to <a href="//www.google.com/chrome">Chrome</a>
                                            version 25 or later.</p>
                                    </div>
                                 <div class="row">
                                        <div id="results" class="col-sm-7">
                                            <span id="final_span" class="final" style="color: red;"></span>
                                            <span id="interim_span" class="interim" style="color:#415dff;"></span>

                                        </div>
                                        <div class="col-sm-2">
                                            <button class="btn btn-sm btn-danger" id="start_button" onclick="startButton(event)">
                                                <img id="start_img" src="{{url('material/img/mic.gif')}}" alt="Start"></button>

                                        </div>
                                    </div>
                                 <div class="row">
                                        <label class="col-sm-2 col-form-label">{{ __('Languages') }}</label>
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <select class="form-control" name="select_language" id="select_language" onchange="updateCountry()"></select>

                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="form-group">

                                                <select class="form-control" id="select_dialect"></select>
                                            </div>
                                        </div>

                                 </div>
                                 <div class="row">
                                        <label class="col-sm-2 col-form-label">{{ __('Controls') }}</label>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <audio name="audio" class="form-control-file" controls id="audio"></audio>
                                            </div>
                                        </div>
                                     <div class="col-sm-6">
                                         <div class="form-group">
                                             <a class="button recordButton " id="record">Record</a>
                                             <a class="button disabled one " id="play">Play</a>
                                             <a class="button disabled one" id="pause">Pause</a>
                                             <a class="button disabled one " id="stop">Reset</a>
                                             <input class="button" type="checkbox" id="live"/>
                                             <label for="live">Live Output</label>
                                         </div>
                                     </div>


                                    </div>
                                 <div class="row">
                                     <label class="col-sm-2 col-form-label">{{ __('Play Back') }}</label>
                                     <div class="col-sm-7">
                                         <canvas id="level" height="200" width="500"></canvas>
                                     </div>
                                 </div>
                                 <div class="row">
                                        <label class="col-sm-2 col-form-label">{{ __('Final text') }}</label>
                                        <div class="col-sm-6">
                                            <div class="form-group{{ $errors->has('answer') ? ' has-danger' : '' }}">
                                                <input class="form-control{{ $errors->has('answer') ? ' is-invalid' : '' }}"  name="answer" id="answer" type="text" placeholder="{{ __('With correct punctuation') }}" value="{{ old('answer') }}" required="true" aria-required="true"/>
                                                @if ($errors->has('answer'))
                                                    <span id="answer-error" class="error text-danger" for="input-answer">{{ $errors->first('answer') }}</span>
                                                @endif
                                            </div>
                                        </div>


                                    </div>
                                <div class="row">
                                    <label class="col-sm-2 col-form-label">{{ __('Question Level') }}</label>
                                    <div class="col-sm-4">
                                        <div class="form-group{{ $errors->has('level') ? ' has-danger' : '' }}">
                                            <select class="form-control" data-style="btn btn-link" id="q_level" name="q_level">
                                                <option value="Elementary">Elementary</option>
                                                <option value="Intermediate">Intermediate</option>
                                                <option value="Advanced">Advanced</option>

                                            </select>
{{--                                            {!! Form::select('q_level', array(1 => 'Elementary', 2 => 'Intermediate',3=>'Advanced'), 1,['class' => 'form-control','id'=>'q_level','name'=>'q_level']); !!}--}}
                                            {{--                                            {!! Form::select('product_id', $groups, 1, ['class' => 'form-control']) !!}--}}

                                            @if ($errors->has('level'))
                                                <span id="level-error" class="error text-danger" for="input-level">{{ $errors->first('level') }}</span>
                                            @endif
                                        </div>

                                    </div>
                                </div>

                            </div>
                            <div class="card-footer ml-auto mr-auto">
                                <button id="ok"   class="btn btn-primary">{{ __('Save') }}</button>
                            </div>
                        </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="{{asset('material/zalmo/Fr.voice.js')}}"></script>
    <script src="{{asset('material/zalmo/recorder.js')}}"></script>
    <script src="{{asset('material/zalmo/jquery.js')}}"></script>

    <script type="text/javascript">

        var langs =
            [['Afrikaans',       ['af-ZA']],
                ['Bahasa Indonesia',['id-ID']],
                ['Bahasa Melayu',   ['ms-MY']],
                ['Català',          ['ca-ES']],
                ['Čeština',         ['cs-CZ']],
                ['Deutsch',         ['de-DE']],
                ['English',         ['en-AU', 'Australia'],
                    ['en-CA', 'Canada'],
                    ['en-IN', 'India'],
                    ['en-NZ', 'New Zealand'],
                    ['en-ZA', 'South Africa'],
                    ['en-GB', 'United Kingdom'],
                    ['en-US', 'United States']],
                ['Español',         ['es-AR', 'Argentina'],
                    ['es-BO', 'Bolivia'],
                    ['es-CL', 'Chile'],
                    ['es-CO', 'Colombia'],
                    ['es-CR', 'Costa Rica'],
                    ['es-EC', 'Ecuador'],
                    ['es-SV', 'El Salvador'],
                    ['es-ES', 'España'],
                    ['es-US', 'Estados Unidos'],
                    ['es-GT', 'Guatemala'],
                    ['es-HN', 'Honduras'],
                    ['es-MX', 'México'],
                    ['es-NI', 'Nicaragua'],
                    ['es-PA', 'Panamá'],
                    ['es-PY', 'Paraguay'],
                    ['es-PE', 'Perú'],
                    ['es-PR', 'Puerto Rico'],
                    ['es-DO', 'República Dominicana'],
                    ['es-UY', 'Uruguay'],
                    ['es-VE', 'Venezuela']],
                ['Euskara',         ['eu-ES']],
                ['Français',        ['fr-FR']],
                ['Galego',          ['gl-ES']],
                ['Hrvatski',        ['hr_HR']],
                ['IsiZulu',         ['zu-ZA']],
                ['Íslenska',        ['is-IS']],
                ['Italiano',        ['it-IT', 'Italia'],
                    ['it-CH', 'Svizzera']],
                ['Magyar',          ['hu-HU']],
                ['Nederlands',      ['nl-NL']],
                ['Norsk bokmål',    ['nb-NO']],
                ['Polski',          ['pl-PL']],
                ['Português',       ['pt-BR', 'Brasil'],
                    ['pt-PT', 'Portugal']],
                ['Română',          ['ro-RO']],
                ['Slovenčina',      ['sk-SK']],
                ['Suomi',           ['fi-FI']],
                ['Svenska',         ['sv-SE']],
                ['Türkçe',          ['tr-TR']],
                ['български',       ['bg-BG']],
                ['Pусский',         ['ru-RU']],
                ['Српски',          ['sr-RS']],
                ['한국어',            ['ko-KR']],
                ['中文',             ['cmn-Hans-CN', '普通话 (中国大陆)'],
                    ['cmn-Hans-HK', '普通话 (香港)'],
                    ['cmn-Hant-TW', '中文 (台灣)'],
                    ['yue-Hant-HK', '粵語 (香港)']],
                ['日本語',           ['ja-JP']],
                ['Lingua latīna',   ['la']]];
        for (var i = 0; i < langs.length; i++) {
            select_language.options[i] = new Option(langs[i][0], i);
        }
        select_language.selectedIndex = 6;
        updateCountry();
        select_dialect.selectedIndex = 6;
        showInfo('info_start');
        function updateCountry() {
            for (var i = select_dialect.options.length - 1; i >= 0; i--) {
                select_dialect.remove(i);
            }
            var list = langs[select_language.selectedIndex];
            for (var i = 1; i < list.length; i++) {
                select_dialect.options.add(new Option(list[i][1], list[i][0]));
            }
            select_dialect.style.visibility = list[1].length == 1 ? 'hidden' : 'visible';
        }
        var create_email = false;
        var final_transcript = '';
        var recognizing = false;
        var ignore_onend;
        var start_timestamp;
        if (!('webkitSpeechRecognition' in window)) {
            upgrade();
        } else {
            start_button.style.display = 'inline-block';
            var recognition = new webkitSpeechRecognition();
            recognition.continuous = true;
            recognition.interimResults = true;
            recognition.onstart = function() {
                recognizing = true;

                showInfo('info_speak_now');
                start_img.src = '{{asset('material/img/mic-animate.gif')}}';

            };
            recognition.onerror = function(event) {
                if (event.error == 'no-speech') {
                    start_img.src = '{{asset('material/img/mic.gif')}}';
                    showInfo('info_no_speech');
                    ignore_onend = true;

                }
                if (event.error == 'audio-capture') {
                    start_img.src = '{{asset('material/img/mic.gif')}}';
                    showInfo('info_no_microphone');
                    ignore_onend = true;

                }
                if (event.error == 'not-allowed') {
                    if (event.timeStamp - start_timestamp < 100) {
                        showInfo('info_blocked');

                    } else {
                        showInfo('info_denied');

                    }
                    ignore_onend = true;

                }
            };
            recognition.onend = function() {
                recognizing = false;

                if (ignore_onend) {
                    return;
                }
                start_img.src = '{{asset('material/img/mic.gif')}}';
                if (!final_transcript) {
                    showInfo('info_start');
                    return;
                }
                showInfo('');
                if (window.getSelection) {
                    window.getSelection().removeAllRanges();
                    var range = document.createRange();
                    range.selectNode(document.getElementById('final_span'));
                    window.getSelection().addRange(range);
                }

            };
            recognition.onresult = function(event) {
                var interim_transcript = '';
                for (var i = event.resultIndex; i < event.results.length; ++i) {
                    if (event.results[i].isFinal) {
                        final_transcript += event.results[i][0].transcript;
                    } else {
                        interim_transcript += event.results[i][0].transcript;
                    }
                }
                final_transcript = capitalize(final_transcript);
                final_span.innerHTML = linebreak(final_transcript);
                interim_span.innerHTML = linebreak(interim_transcript);
                if (final_transcript || interim_transcript) {
                    showButtons('inline-block');
                }
            };

        }

        function upgrade() {
            start_button.style.visibility = 'hidden';
            showInfo('info_upgrade');
        }

        var two_line = /\n\n/g;
        var one_line = /\n/g;
        function linebreak(s) {
            return s.replace(two_line, '<p></p>').replace(one_line, '<br>');
        }
        var first_char = /\S/;
        function capitalize(s) {
            return s.replace(first_char, function(m) { return m.toUpperCase(); });
        }
        function startButton(event) {
            if (recognizing) {
                recognition.stop();

                return;
            }
            final_transcript = '';
            recognition.lang = select_dialect.value;
            recognition.start();


            ignore_onend = false;
            final_span.innerHTML = '';
            interim_span.innerHTML = '';
            start_img.src = '{{asset('material/img/mic-slash.gif')}}';
            showInfo('info_allow');
            showButtons('none');
            start_timestamp = event.timeStamp;
        }
        function showInfo(s) {
            if (s) {
                for (var child = info.firstChild; child; child = child.nextSibling) {
                    if (child.style) {
                        child.style.display = child.id == s ? 'inline' : 'none';
                    }
                }
                info.style.visibility = 'visible';
            } else {
                info.style.visibility = 'hidden';
            }
        }
        var current_style;
        function showButtons(style) {
            if (style == current_style) {
                return;
            }
            current_style = style;

        }


    </script>

    <script type="text/javascript">
        function restore(){
            $("#record, #live").removeClass("disabled");
            $("#pause").replaceWith('<a class="button one" id="pause">Pause</a>');
            $(".one").addClass("disabled");
            Fr.voice.stop();
        }

        function makeWaveform(){
            var analyser = Fr.voice.recorder.analyser;

            var bufferLength = analyser.frequencyBinCount;
            var dataArray = new Uint8Array(bufferLength);

            /**
             * The Waveform canvas
             */
            var WIDTH = 500,
                HEIGHT = 200;

            var canvasCtx = $("#level")[0].getContext("2d");
            canvasCtx.clearRect(0, 0, WIDTH, HEIGHT);

            function draw() {
                var drawVisual = requestAnimationFrame(draw);

                analyser.getByteTimeDomainData(dataArray);

                canvasCtx.fillStyle = 'rgb(200, 200, 200)';
                canvasCtx.fillRect(0, 0, WIDTH, HEIGHT);
                canvasCtx.lineWidth = 2;
                canvasCtx.strokeStyle = 'rgb(0, 0, 0)';

                canvasCtx.beginPath();

                var sliceWidth = WIDTH * 1.0 / bufferLength;
                var x = 0;
                for(var i = 0; i < bufferLength; i++) {
                    var v = dataArray[i] / 128.0;
                    var y = v * HEIGHT/2;

                    if(i === 0) {
                        canvasCtx.moveTo(x, y);
                    } else {
                        canvasCtx.lineTo(x, y);
                    }

                    x += sliceWidth;
                }
                canvasCtx.lineTo(WIDTH, HEIGHT/2);
                canvasCtx.stroke();
            };
            draw();
        }

        $(document).ready(function(){
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

                }
            });
            $(document).on("click", "#record:not(.disabled)", function(){
                Fr.voice.record($("#live").is(":checked"), function(){
                    $(".recordButton").addClass("disabled");

                    $("#live").addClass("disabled");
                    $(".one").removeClass("disabled");

                    makeWaveform();
                });
            });

            $(document).on("click", "#recordFor5:not(.disabled)", function(){
                Fr.voice.record($("#live").is(":checked"), function(){
                    $(".recordButton").addClass("disabled");

                    $("#live").addClass("disabled");
                    $(".one").removeClass("disabled");

                    makeWaveform();
                });

                Fr.voice.stopRecordingAfter(12000, function(){
                    alert("Recording stopped after 9 seconds");
                    $("#record, #live").removeClass("disabled");
                });
                Fr.voice.stop();
                $("#record, #live").removeClass("disabled");
                $("#pause").replaceWith('<a class="button one" id="pause">Pause</a>');
                $(".one").addClass("disabled");

            });

            $(document).on("click", "#pause:not(.disabled)", function(){
                if($(this).hasClass("resume")){
                    Fr.voice.resume();
                    recognition.stop();
                    $(this).replaceWith('<a class="button one" id="pause">Pause</a>');
                }else{
                    Fr.voice.pause();
                    $(this).replaceWith('<a class="button one resume" id="pause">Resume</a>');
                }
            });

            $(document).on("click", "#stop:not(.disabled)", function(){
                Fr.voice.stop();
                recognition.stop();
                $("#record, #live").removeClass("disabled");
                $("#pause").replaceWith('<a class="button one" id="pause">Pause</a>');
                $(".one").addClass("disabled");
            });

            $(document).on("click", "#play:not(.disabled)", function(){
                if($(this).parent().data("type") === "mp3"){
                    Fr.voice.exportMP3(function(url){
                        $("#audio").attr("src", url);
                        $("#audio")[0].play();
                    }, "URL");
                }else{
                    Fr.voice.export(function(url){
                        $("#audio").attr("src", url);
                        $("#audio")[0].play();
                    }, "URL");
                }
                Fr.voice.stop();
                recognition.stop();
                $("#record, #live").removeClass("disabled");
                $("#pause").replaceWith('<a class="button one" id="pause">Pause</a>');
                $(".one").addClass("disabled");
            });

            $(document).on("click", "#download:not(.disabled)", function(){
                if($(this).parent().data("type") === "mp3"){
                    Fr.voice.exportMP3(function(url){
                        $("<a href='" + url + "' download='MyRecording.mp3'></a>")[0].click();
                    }, "URL");
                }else{
                    Fr.voice.export(function(url){
                        $("<a href='" + url + "' download='MyRecording.wav'></a>")[0].click();
                    }, "URL");
                }
                Fr.voice.stop();
                recognition.stop();
                $("#record, #live").removeClass("disabled");
                $("#pause").replaceWith('<a class="button one" id="pause">Pause</a>');
                $(".one").addClass("disabled");
            });

            $(document).on("click", "#base64:not(.disabled)", function(){
                    Fr.voice.export(function(url){
                        console.log(url);
                        alert("Check the web console for the URL");

                        $("<a href='"+ url +"' target='_blank'></a>")[0].click();
                    }, "base64");

                Fr.voice.stop();

                $("#record, #live").removeClass("disabled");
                $("#pause").replaceWith('<a class="button one" id="pause">Pause</a>');
                $(".one").addClass("disabled");
            });

            $(document).on("click", "#save:not(.disabled)", function(){
                function upload(blob){
                    var formData = new FormData();
                    formData.append('file', blob);

                    $.ajax({
                        url: "{{route('zalmox.store')}}",
                        type: 'POST',
                        data: formData,
                        contentType: false,
                        processData: false,
                        success: function(url) {
                            $("#audio").attr("src", url);
                            $("#audio")[0].play();
                            alert("Saved In Server. See audio element's src for URL");
                        }
                    });
                }
                if($(this).parent().data("type") === "mp3"){
                    Fr.voice.exportMP3(upload, "blob");
                }else{
                    Fr.voice.export(upload, "blob");
                }
                Fr.voice.stop();
                $("#record, #live").removeClass("disabled");
                $("#pause").replaceWith('<a class="button one" id="pause">Pause</a>');
                $(".one").addClass("disabled");
            });

            $(document).on("click",'#ok',function (e) {

                e.preventDefault();
                var answer = $("input[name=answer]").val();

                var language =jQuery('#select_language').val();

                var level = jQuery('#q_level').val();

                Fr.voice.export(function(base64){
                    var data = new FormData();

                    data.append('file', base64);
                    data.append('answer',answer);
                    data.append('language',language);
                    data.append('level',level);
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                        }
                    });
                    $.ajax({
                        type:'POST',
                        url:"{{route('zalmox.store')}}",
                        data:data,
                            contentType: false,
                            processData: false,
                        success:function (result) {

                            console.log(result);
                        },

                    }

                    );


                }, "base64");
            })
        });

    </script>
@endsection
