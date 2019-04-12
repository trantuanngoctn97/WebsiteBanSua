<script type="text/javascript">
    $(document).ready(function() {
        // Click thay đổi ảnh chi tiết sản phẩm
        $('.img_detail').click(function(event) {
            event.preventDefault();
            var link = $(this).attr('src');
            $('#proimage').attr('src',link);
        });

        // Click vào hiện reply comment
        var replyComment = function(){
            $('.reply-comment').unbind('click').click(function(event) {
                event.preventDefault();
                $(this).closest('.form-group').next('.formComment').slideToggle();
            });
        }
        replyComment();

        // Post comment
        var formComment = function(){
            $('.formComment').unbind('submit').submit(function(event) {
                event.preventDefault();
                var _token = $('input[name="_token"]').val();
                var body = $(this).find('textarea[name="body"]').val();
                var product_id = $(this).find('input[name="product_id"]').val();
                var parent_id = $(this).find('input[name="parent_id"]').val();
                var _self = $(this);

                var dataSend = new FormData();
                dataSend.append('_token', _token);
                dataSend.append('body', body);
                dataSend.append('product_id', product_id);
                dataSend.append('parent_id', parent_id);

                $.ajax({
                    url: '{{ route('web.product.comment.store') }}',
                    type: 'POST',
                    dataType: 'html',
                    contentType: false,
                    processData: false,
                    data: dataSend,
                    success: function(data){
                        console.log('success');
                        // console.log(data);
                        $(_self).next('hr').next('.display-replies').prepend(data);
                        replyComment();
                        formComment();
                        $(_self).trigger("reset");
                        $(_self).hide();

                    },
                    error: function(data){
                        console.log(data);
                        alert('Bình luận không thành công. Vui lòng tải lại trang.');
                        location.reload();
                    }
                });
            });
        }
        formComment();
    });
</script>