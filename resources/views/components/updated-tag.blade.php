@if(($post->updated_at > $post->created_at))
    <p class="text-muted position-absolute small" style="bottom: 0; right: 1; padding: 5px; margin: 10px;" >
    Editado el {{$post->updated_at->format('M j, Y, h:i A')}}
    </p>
@endif
