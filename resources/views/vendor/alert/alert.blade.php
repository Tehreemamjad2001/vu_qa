@if(isset($messageType)&&!empty($messageType))
    <div class="note note-{{$messageType}}">
        <p>
            {{isset($message) && !empty($message) ? $message : ""}}
        </p>
    </div>
@endif