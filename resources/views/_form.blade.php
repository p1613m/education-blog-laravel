<div>
    <label>
        Post title:<br>
        <input type="text" placeholder="Post title" name="title" value="{{ old('title', $post?->title) }}">
        @error('title') {{ $message }} @enderror
    </label>
</div>
<div>
    <label>
        Post description:<br>
        <textarea placeholder="Post description" name="description">{{ old('description', $post?->description) }}</textarea>
        @error('description') {{ $message }} @enderror
    </label>
</div>
<div>
    <label>
        Post content:<br>
        <textarea placeholder="Post content" name="content">{{ old('content', $post?->content) }}</textarea>
        @error('content') {{ $message }} @enderror
    </label>
</div>
<div>
    <label>
        Post image:<br>
        @if($post?->image_url)
            <img src="{{ $post->image_url }}" alt="" style="display: block; width: 150px;">
        @endif
        <input type="file" name="image">
        @error('image') {{ $message }} @enderror
    </label>
</div>

