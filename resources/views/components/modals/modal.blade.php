<div>
    <div class="modal fade" id="{{$type}}" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div {{$attributes->merge(['class'=>'modal-dialog'])}}>
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">{{$judul}}</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            {{$slot}}
          </div>
        </div>
      </div>
</div>