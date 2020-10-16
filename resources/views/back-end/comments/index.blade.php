<table class="table" id="comments">
    <tbody>
        @foreach ($comments as $comment)
            <tr>
                <td>
                    <small>{{ $comment->user->name }}</small>
                    <p>{{ $comment->comment }}</p>
                    <small>{{ $comment->created_at }}</small>
                </td>
                <td class="td-actions text-right">
                    <button type="button" rel="tooltip" title=""
                        onclick="$(this).closest('tr').next('tr').slideToggle()" class="btn btn-white btn-link btn-sm"
                        data-original-title="Edit Comment">
                        <i class="material-icons">edit</i>
                    </button>
                    <a href="{{ route('comment.delete', $comment->id) }}" rel="tooltip"
                        class="btn btn-white btn-link btn-sm" data-original-title="Remove Comment">
                        <i class="material-icons">close</i>
                    </a>
                </td>
            </tr>
            <tr style="display:none; ">
                <td colspan="4">
                    <form action="{{ route('comment.update', $comment->id) }}" method="post">
                        {{ csrf_field() }}
                        @include('back-end.comments.form' , $comment )
                        <input type="hidden" value="{{ $row->id }}" name='video_id'>
                        <button type="submit" class="btn btn-primary pull-right">Update Comment</button>
                        <div class="clearfix"></div>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
