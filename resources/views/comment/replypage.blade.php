@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row">
    <h4>Reply</h4>
    <div class="col-sm-8">
      <div class="row">
        <div class="col-8">
          <div class="offset-1">
            <h6> {{ $comment_info->comment_email }}</h6>
            <p>{{ $comment_info->user_comment }}</p>
          </div>
        </div>
      </div>

    </div>
  </div>
</div>
<div class="container" style="margin: 100px 90px;">
{{ $comment_info->id }}
    <div class="col-sm-8">
      <form method="post" action="{{ url('reply/insert') }}">
        @csrf
        <div class="form-group">
          <label for="exampleInputEmail1">Email address</label>
          <input type="email" name="reply_email" class="form-control" placeholder="Enter email">

        </div>
        <div class="form-group">
          <label for="exampleInputPassword1">Comment</label>
          <input type="text" name="reply_comment" class="form-control"  placeholder="Password">
          <input type="hidden" name="comment_id" class="form-control" value="{{ $comment_info->id }}">

        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
      </form>
    </div>

</div>
<script type="text/javascript">
    function myFunction() {
        document.getElementById("demo").style.color = "red";
        document.getElementById("demo").style.color = "red";
    }
</script>
@endsection
