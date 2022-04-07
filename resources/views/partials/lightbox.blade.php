<div class="modal fade" id="lightbox_{{ $item->id }}" role="dialog" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div id="indicators" class="carousel slide" data-interval="false">
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img class="d-block w-100" src="{{ $item->getImg() }}">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

