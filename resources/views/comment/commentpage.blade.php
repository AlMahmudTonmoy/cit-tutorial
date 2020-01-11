@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row">
    <div class="col-sm-8">
      @foreach($comments as $comment)
      <div class="row">
        <div class="col-8">
          {{ $loop->index+1 }} .
          <div class="offset-1">
            <input type="hidden" name="comment_filter_id" value="{{ $comment->id }}">
            <h6> {{ $comment->comment_email }}</h6>
            <p>{{ $comment->user_comment }}</p>
            <a href="{{url('comment/reply')}}/{{ $comment->id }}">reply</a>
            <div class="col-sm-8">
              @foreach( $comment->relreptab as $amt)
              <div class="row">
                <div class="col-8">
                  {{ $loop->index+1 }} .
                  <div class="offset-1">
                    <input type="hidden" name="comment_filter_id" value="{{ $comment->id }}">
                    <h6> {{ $amt->reply_email }}</h6>
                    <p>{{ $amt->reply_comment }}</p>


                  </div>

                </div>
              </div>
              @endforeach
            </div>
          </div>

        </div>
      </div>
      @endforeach
    </div>
  </div>
</div>
<div class="container" style="margin: 100px 90px;">

    <div class="col-sm-8">
      <form method="post" action="{{ url('comment/insert') }}">
        @csrf
        <div class="form-group">
          <label for="exampleInputEmail1">Email address</label>
          <input type="email" name="comment_email" class="form-control" placeholder="Enter email">

        </div>
        <div class="form-group">
          <label for="exampleInputPassword1">Comment</label>
          <input type="text" name="user_comment" class="form-control"  placeholder="Password">
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
