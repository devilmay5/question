@foreach ($title_list as $item)
    <a href="question_info/{{$item->id}}">{{$item->name}}</a>
    <br>
@endforeach
