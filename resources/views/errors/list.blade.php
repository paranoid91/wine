@if($errors->any())
<ul class="alert alert-danger list-unstyled">
    @foreach($errors->all() as $error)
    <li>{{ $error }}</li>
    @endforeach
</ul>
@else
    @if(Request::input('message') == 'sent')
        <div class="alert alert-success">
            {{trans('front.contact_message_has_been_sent_successfully')}}
        </div>
    @endif
@endif