
<!-- Modal -->
<div id="PlayerModal" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">{{trans('admin.product_movie')}}</h4>
            </div>
            <div class="modal-body">
                <video width="100%" id="player" controls>
                    <source type="video/mp4" src="">
                </video>
            </div>
        </div>
    </div>
</div>
<script>
    $(function(){
        $('.setmovie').click(function(){
            var video = document.getElementById('player');
            video.src = $(this).data('movie');
            video.load();
        });
    });
</script>