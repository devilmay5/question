<form method="post" action="/question_list">
    {{csrf_field()}}
@foreach ($info_list as $item1)
    <div>
        <p>{{$item1->name}}</p>
        <p><img src="{{config("filesystems.disks.admin.url").$item1->image_url}}"></p>
        <div>
            <input type="radio" name="answer[{{$item1->id}}]" value="A">  {{$item1->answer_A}}
            <br/>
            <input type="radio" name="answer[{{$item1->id}}]" value="B">  {{$item1->answer_B}}
            <br/>
            <input type="radio" name="answer[{{$item1->id}}]" value="C">  {{$item1->answer_C}}
            <br/>
            <input type="radio" name="answer[{{$item1->id}}]" value="D">  {{$item1->answer_D}}
            <br/>
        </div>
    </div>
@endforeach
    <input type="submit" value="提交">
</form>