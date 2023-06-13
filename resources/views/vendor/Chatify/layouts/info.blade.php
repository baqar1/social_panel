{{-- user info and avatar --}}
<div class="avatar av-l chatify-d-flex"></div>
{{-- <div class="avatar av-l chatify-d-flex">
    <img src="{{asset('storage/uploads')}}/{{ auth()->user()->user_image}}" alt="" width="170" height="120">
</div> --}}
<p class="info-name">{{ auth()->user()->name }}</p>
<div class="messenger-infoView-btns">
    <a href="#" class="danger delete-conversation">Delete Conversation</a>
</div>
{{-- shared photos --}}
<div class="messenger-infoView-shared">
    <p class="messenger-title"><span>Shared Photos</span></p>
    <div class="shared-photos-list"></div>
</div>
