@props(
    [
        "text",
        "action",
        "commentId"
    ]
)
<div class="form-check form-switch ms-2">
    <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDefault-{{$commentId}}">
    <label class="form-check-label" for="flexSwitchCheckDefault-{{$commentId}}">{{$text}}</label>
</div>

