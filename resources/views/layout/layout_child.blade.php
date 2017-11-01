<ul>
    @foreach($childs as $row)
        <li>
            <strong>{{$row->code}}</strong>-{{$row->name}} <button><i class="fa fa-plus"></i></button>
            @if(count($row->childs))
                @include('layout.layout_child',['childs' => $row->childs])
            @endif
        </li>
    @endforeach
</ul>