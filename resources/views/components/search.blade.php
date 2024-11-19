{{--
<form action="{{ $searchRoute }}" method="GET" class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
    <div class="input-group">
        @if($topicId)
            <input type="hidden" name="topic_id" value="{{ $topicId }}" />
        @endif
        <input class="form-control" name="search" type="text" placeholder="Search for..." aria-label="Search for..." aria-describedby="btnNavbarSearch" />
        <button class="btn btn-primary" id="btnNavbarSearch" type="submit"><i class="fas fa-search"></i></button>
    </div>
</form> --}}
<form action="{{ $searchRoute }}" method="GET" class="form-inline ms-auto me-0 my-2">
    <div class="input-group w-50">
        @if($topicId)
            <input type="hidden" name="topic_id" value="{{ $topicId }}" />
        @endif
        <input
            class="form-control"
            name="search"
            type="text"
            placeholder="Search for..."
            aria-label="Search for..."
            aria-describedby="btnNavbarSearch"
        />
        <button class="btn btn-primary" id="btnNavbarSearch" type="submit">
            <i class="fas fa-search"></i>
        </button>
    </div>
</form>
