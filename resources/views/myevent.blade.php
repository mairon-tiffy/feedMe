<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

        <!-- Styles -->
        <style>
            /*! normalize.css v8.0.1 | MIT License | github.com/necolas/normalize.css */html{line-height:1.15;-webkit-text-size-adjust:100%}body{margin:0}a{background-color:transparent}[hidden]{display:none}html{font-family:system-ui,-apple-system,BlinkMacSystemFont,Segoe UI,Roboto,Helvetica Neue,Arial,Noto Sans,sans-serif,Apple Color Emoji,Segoe UI Emoji,Segoe UI Symbol,Noto Color Emoji;line-height:1.5}*,:after,:before{box-sizing:border-box;border:0 solid #e2e8f0}a{color:inherit;text-decoration:inherit}svg,video{display:block;vertical-align:middle}video{max-width:100%;height:auto}.bg-white{--bg-opacity:1;background-color:#fff;background-color:rgba(255,255,255,var(--bg-opacity))}.bg-gray-100{--bg-opacity:1;background-color:#f7fafc;background-color:rgba(247,250,252,var(--bg-opacity))}.border-gray-200{--border-opacity:1;border-color:#edf2f7;border-color:rgba(237,242,247,var(--border-opacity))}.border-t{border-top-width:1px}.flex{display:flex}.grid{display:grid}.hidden{display:none}.items-center{align-items:center}.justify-center{justify-content:center}.font-semibold{font-weight:600}.h-5{height:1.25rem}.h-8{height:2rem}.h-16{height:4rem}.text-sm{font-size:.875rem}.text-lg{font-size:1.125rem}.leading-7{line-height:1.75rem}.mx-auto{margin-left:auto;margin-right:auto}.ml-1{margin-left:.25rem}.mt-2{margin-top:.5rem}.mr-2{margin-right:.5rem}.ml-2{margin-left:.5rem}.mt-4{margin-top:1rem}.ml-4{margin-left:1rem}.mt-8{margin-top:2rem}.ml-12{margin-left:3rem}.-mt-px{margin-top:-1px}.max-w-6xl{max-width:72rem}.min-h-screen{min-height:100vh}.overflow-hidden{overflow:hidden}.p-6{padding:1.5rem}.py-4{padding-top:1rem;padding-bottom:1rem}.px-6{padding-left:1.5rem;padding-right:1.5rem}.pt-8{padding-top:2rem}.fixed{position:fixed}.relative{position:relative}.top-0{top:0}.right-0{right:0}.shadow{box-shadow:0 1px 3px 0 rgba(0,0,0,.1),0 1px 2px 0 rgba(0,0,0,.06)}.text-center{text-align:center}.text-gray-200{--text-opacity:1;color:#edf2f7;color:rgba(237,242,247,var(--text-opacity))}.text-gray-300{--text-opacity:1;color:#e2e8f0;color:rgba(226,232,240,var(--text-opacity))}.text-gray-400{--text-opacity:1;color:#cbd5e0;color:rgba(203,213,224,var(--text-opacity))}.text-gray-500{--text-opacity:1;color:#a0aec0;color:rgba(160,174,192,var(--text-opacity))}.text-gray-600{--text-opacity:1;color:#718096;color:rgba(113,128,150,var(--text-opacity))}.text-gray-700{--text-opacity:1;color:#4a5568;color:rgba(74,85,104,var(--text-opacity))}.text-gray-900{--text-opacity:1;color:#1a202c;color:rgba(26,32,44,var(--text-opacity))}.underline{text-decoration:underline}.antialiased{-webkit-font-smoothing:antialiased;-moz-osx-font-smoothing:grayscale}.w-5{width:1.25rem}.w-8{width:2rem}.w-auto{width:auto}.grid-cols-1{grid-template-columns:repeat(1,minmax(0,1fr))}@media (min-width:640px){.sm\:rounded-lg{border-radius:.5rem}.sm\:block{display:block}.sm\:items-center{align-items:center}.sm\:justify-start{justify-content:flex-start}.sm\:justify-between{justify-content:space-between}.sm\:h-20{height:5rem}.sm\:ml-0{margin-left:0}.sm\:px-6{padding-left:1.5rem;padding-right:1.5rem}.sm\:pt-0{padding-top:0}.sm\:text-left{text-align:left}.sm\:text-right{text-align:right}}@media (min-width:768px){.md\:border-t-0{border-top-width:0}.md\:border-l{border-left-width:1px}.md\:grid-cols-2{grid-template-columns:repeat(2,minmax(0,1fr))}}@media (min-width:1024px){.lg\:px-8{padding-left:2rem;padding-right:2rem}}@media (prefers-color-scheme:dark){.dark\:bg-gray-800{--bg-opacity:1;background-color:#2d3748;background-color:rgba(45,55,72,var(--bg-opacity))}.dark\:bg-gray-900{--bg-opacity:1;background-color:#1a202c;background-color:rgba(26,32,44,var(--bg-opacity))}.dark\:border-gray-700{--border-opacity:1;border-color:#4a5568;border-color:rgba(74,85,104,var(--border-opacity))}.dark\:text-white{--text-opacity:1;color:#fff;color:rgba(255,255,255,var(--text-opacity))}.dark\:text-gray-400{--text-opacity:1;color:#cbd5e0;color:rgba(203,213,224,var(--text-opacity))}.dark\:text-gray-500{--tw-text-opacity:1;color:#6b7280;color:rgba(107,114,128,var(--tw-text-opacity))}}
        </style>

        <style>
            body {
                font-family: 'Nunito', sans-serif;
            }
        </style>

        <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    </head>
    <body>
        <form action="{{route('events.store')}}" method="POST" enctype="multipart/form-data">
        @csrf
            <div class="event_container">
                <label for="title">Title of your event</label>
                <input type="text" id="title" name="title">
                @error('title')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                <label for="event_type">Type of the event</label>
                    <select name="event_type">
                        <option value="0">Dinner</option>
                        <option value="1">Lunch</option>
                        <option value="2">Brunch</option>
                        <option value="3">Breakfast</option>
                        <option value="4">Tea time</option>
                        <option value="5">Picnic</option>
                        <option value="6">Others</option>
                    </select>
                <label for="cuisine_type">Type of the cuisine</label>
                    <select name="cuisine_type">
                        <option value="0">Italian</option>
                        <option value="1">French</option>
                        <option value="2">Japanese</option>
                        <option value="3">Greek</option>
                        <option value="4">Mediterranean</option>
                        <option value="5">Spanish</option>
                        <option value="6">Mexican</option>
                        <option value="7">Korean</option>
                        <option value="8">Thai</option>
                        <option value="9">Asian</option>
                        <option value="10">Europian</option>
                        <option value="11">African</option>
                        <option value="12">Others</option>
                    </select>
                <label for="special_diet">Special diet</label>
                    <select name="special_diet">
                        <option value="0">Anything</option>
                        <option value="1">Vegetalian</option>
                        <option value="2">Vegan</option>
                        <option value="3">Allergic to Gluten</option>
                        <option value="4">Allergic to Nuts</option>
                        <option value="5">Allergic to Shellfish</option>
                        <option value="6">Allergic to Soy beans</option>
                        <option value="7">No Pork</option>
                        <option value="8">No Alchole</option>
                    </select>
                <label for="number">Number of the guest</label>
                    <input type="number" name="number_from">

                    @error('number_from')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror

                    to<input type="number" name="number_to">

                    @error('number_to')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror

                <label for="content">A word about the experience</label>
                <textarea name="content" id="content" cols="60" rows="5"></textarea>
                @error('content')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror

                <label for="place">Place</label>
                <input type="text" id="place" name="place">
                @error('text')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror

                
            </div>
            <div class="schedule">
                <label for="avalable_date">date of the event</label>
                <input type="date" id="avalable_date" name="avalable_date">
                @error('avalable_date')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror

                <label for="avalable_time">time of the event</label>
                <input type="time" id="avalable_time" name="avalable_time">
                @error('avalable_time')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror

            </div>
            <div class="payment">
                <label for="currecy_type">Currency</label>
                    <select name="currecy_type">
                        <option value="0">USD</option>
                        <option value="1">JPY</option>
                        <option value="2">AUD</option>
                        <option value="3">CAD</option>
                        <option value="4">EUR</option>
                        <option value="5">CNY</option>
                        <option value="6">TWD</option>
                        <option value="7">KRW</option>
                        <option value="8">SEK</option>
                        <option value="9">SGD</option>
                        <option value="10">Others</option>
                    </select>
                <label for="price">Price</label>
                <input type="text" id="price" name="price">
                @error('price')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="imageArea">
                <input type="file" id="file" name="files[]" class="form-control" multiple>
                <input type="button" value="＋" class="add pluralBtn">
                <input type="button" value="－" class="del pluralBtn">
                <img width="200px"></img>

                @error('files.*')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>    

            <button type='submit'>submit</button>
        </form>
        <!-- プレビュー -->
        <div class="preview">
        </div>

    <!-- <div id="input_pluralBox">
        <div id="input_plural">
            <input type="text" class="form-control" placeholder="サンプルテキストサンプルテキストサンプルテキスト">
            <input type="button" value="＋" class="add pluralBtn">
            <input type="button" value="－" class="del pluralBtn">
        </div>
    </div> -->


    </body>
</html>


<script>
    $(function(){
        $("[name='files[]']").on('change', function (e) {
            let $this = $(this);
            var reader = new FileReader();
            
            reader.onload = function (e) {
                // $(".preview").attr('src', e.target.result);
                // console.log($this.next().next().next());
                $this.next().next().next().attr('src', e.target.result);
                // $(this).next().next().attr('src', e.target.result);
            }

            reader.readAsDataURL(e.target.files[0]);  

        });
    });
</script>

<script type="text/javascript">
    $(document).on("click", ".add", function() {
        // let div = $(this).parent();
        // div.children().first().val("");
        
        $(this).parent().clone(true).insertAfter($(this).parent()).children().first().val("");
        console.log($(this).parent().next().find('img'));
        $(this).parent().next().find('img').attr('src', "");
        // $('.imageArea').append();

    });
    $(document).on("click", ".del", function() {
        var target = $(this).parent();
        if (target.parent().children().length > 1) {
            target.remove();
        }
    });
</script>
