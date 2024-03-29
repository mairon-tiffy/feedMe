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
    </head>
    <body>
        <form action="{{route('events.update' , ['event' => $event['id']])}}" method="POST">
            @csrf
            @method('PATCH')
            <div class="event_container">
                <label for="title">Title of your event</label>
                <input type="text" id="title" name="title" value="{{ $event['title']}}">
                <label for="cuisine_type">Type of the cuisine</label>
                    <select name="cuisine_type">
                        <option value="0" {{ $event['cuisine_type'] == "0" ? 'selected' : '' }}>Italian</option>
                        <option value="1" {{ $event['cuisine_type'] == "1" ? 'selected' : '' }}>French</option>
                        <option value="2" {{ $event['cuisine_type'] == "2" ? 'selected' : '' }}>Japanese</option>
                        <option value="3" {{ $event['cuisine_type'] == "3" ? 'selected' : '' }}>Greek</option>
                        <option value="4" {{ $event['cuisine_type'] == "4" ? 'selected' : '' }}>Mediterranean</option>
                        <option value="5" {{ $event['cuisine_type'] == "5" ? 'selected' : '' }}>Spanish</option>
                        <option value="6" {{ $event['cuisine_type'] == "6" ? 'selected' : '' }}>Mexican</option>
                        <option value="7" {{ $event['cuisine_type'] == "7" ? 'selected' : '' }}>Korean</option>
                        <option value="8" {{ $event['cuisine_type'] == "8" ? 'selected' : '' }}>Thai</option>
                        <option value="9" {{ $event['cuisine_type'] == "9" ? 'selected' : '' }}>Asian</option>
                        <option value="10" {{ $event['cuisine_type'] == "10" ? 'selected' : '' }}>Europian</option>
                        <option value="11" {{ $event['cuisine_type'] == "11" ? 'selected' : '' }}>African</option>
                        <option value="12" {{ $event['cuisine_type'] == "12" ? 'selected' : '' }}>Others</option>
                    </select>
                <label for="special_diet">Special diet</label>
                    <select name="special_diet">
                        <option value="0" {{ $event['special_diet'] == "0" ? 'selected' : '' }}>Anything</option>
                        <option value="1" {{ $event['special_diet'] == "1" ? 'selected' : '' }}>Vegetalian</option>
                        <option value="2" {{ $event['special_diet'] == "2" ? 'selected' : '' }}>Vegan</option>
                        <option value="3" {{ $event['special_diet'] == "3" ? 'selected' : '' }}>Allergic to Gluten</option>
                        <option value="4" {{ $event['special_diet'] == "4" ? 'selected' : '' }}>Allergic to Nuts</option>
                        <option value="5" {{ $event['special_diet'] == "5" ? 'selected' : '' }}>Allergic to Shellfish</option>
                        <option value="6" {{ $event['special_diet'] == "6" ? 'selected' : '' }}>Allergic to Soy beans</option>
                        <option value="7" {{ $event['special_diet'] == "7" ? 'selected' : '' }}>No Pork</option>
                        <option value="8" {{ $event['special_diet'] == "8" ? 'selected' : '' }}>No Alchole</option>
                    </select>
                <label for="content">A word about the experience</label>
                <textarea name="content" id="content" cols="60" rows="5" >{{ $event['content']}}</textarea>
            </div>
            <div class="payment">
                <label for="currecy_type">Currency</label>
                    <select name="currecy_type">
                        <option value="0" {{ $event['currecy_type'] == "0" ? 'selected' : '' }}>USD</option>
                        <option value="1" {{ $event['currecy_type'] == "1" ? 'selected' : '' }}>JPY</option>
                        <option value="2" {{ $event['currecy_type'] == "2" ? 'selected' : '' }}>AUD</option>
                        <option value="3" {{ $event['currecy_type'] == "3" ? 'selected' : '' }}>CAD</option>
                        <option value="4" {{ $event['currecy_type'] == "4" ? 'selected' : '' }}>EUR</option>
                        <option value="5" {{ $event['currecy_type'] == "5" ? 'selected' : '' }}>CNY</option>
                        <option value="6" {{ $event['currecy_type'] == "6" ? 'selected' : '' }}>TWD</option>
                        <option value="7" {{ $event['currecy_type'] == "7" ? 'selected' : '' }}>KRW</option>
                        <option value="8" {{ $event['currecy_type'] == "8" ? 'selected' : '' }}>SEK</option>
                        <option value="9" {{ $event['currecy_type'] == "9" ? 'selected' : '' }}>SGD</option>
                        <option value="10" {{ $event['currecy_type'] == "10" ? 'selected' : '' }}>Others</option>
                    </select>
                @foreach($event->images as $image)
                    <img src="{{ asset('storage/'.$image['image']) }}">
                @endforeach
            </div>
            <button type='submit'>update</button>
        </form>
        <form action="{{route('eventDetailcreate' , ['event_id' => $event['id']])}}" method="GET">
            <button type='submit'> set the event date</button>
        </form>

        <div class="event_details_index">
            @foreach($event_details as $event_detail)
                <a href="{{ route('eventdetails.edit',['eventdetail' => $event_detail['id']])}}">{{ $event_detail['avalable_time']}}<br></a>
            @endforeach
        </div>
    </body>
</html>
