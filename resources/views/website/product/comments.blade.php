<div class="display-comment" @if($comment->parent_id != null) style="margin-left:30px;" @endif>
    <div class="row">
        <div class="col-md-1">
            <img src="{{$comment->user->ThumbUser}}" class="avatar img-circle">
        </div>
        <div class="col-md-11">
            <strong class="text-success">{{ '@'.$comment->user->name }}</strong>
            <p>{{ $comment->body }}</p>
            <div class="form-group">
                <span class="rte" title="{{$comment->created_at->format('H:i:s - d/m/Y')}}">{{$comment->created_at->diffForHumans()}}</span> 
                @if (auth()->check())
                <a href="javascript:void(0)" class="reply-comment"><i class="fa fa-share"></i> Reply</a>
                @endif
            </div>
            @if (auth()->check())
            <form method="post" action="{{ route('web.product.comment.store') }}" class="formComment">
                @csrf
                <div class="form-group">
                    <textarea name="body" class="form-control" rows="3" required="" minlength="30" maxlength="250" placeholder="Nội dung bình luận"></textarea>
                    <small class="text-danger err-msg"></small>
                    <input type="hidden" name="product_id" value="{{ $product_id }}" />
                    <input type="hidden" name="parent_id" value="{{ $comment->id }}" />
                    <input type="hidden" name="type_comment" value="reply_comment" />
                </div>
                <div class="form-group">
                    <input type="submit" class="btn btn-warning btn-reply-comment" value="Reply" />
                </div>
            </form>
            @endif
            <hr>
            <div class="display-replies">

            </div>
        </div>
    </div>
</div>





