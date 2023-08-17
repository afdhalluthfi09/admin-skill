<x-dashboard-layout>
    @php
        $boy =$youtube->whereIn('title', 'Bootcamp');
    @endphp
    <section class="d-flex">
        <a role="button" href="{{ route('kelas.listkelas') }}" class="btn btn-success btn-small">Kembali</a>
    </section>
    <section class="row">
        <div class="col-md-8">
            <div class='cover'>
                @php
                    echo $boy[0]['embed'];
                @endphp
            </div>
            {{-- @dd($boy[0]['embed']) --}}
            <div class="card">
                <div class="card-body">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                          <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home-tab-pane" type="button" role="tab" aria-controls="home-tab-pane" aria-selected="true">Deskripsi</button>
                        </li>
                        <li class="nav-item" role="presentation">
                          <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile-tab-pane" type="button" role="tab" aria-controls="profile-tab-pane" aria-selected="false">Download</button>
                        </li>
                        {{-- <li class="nav-item" role="presentation">
                          <button class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#contact-tab-pane" type="button" role="tab" aria-controls="contact-tab-pane" aria-selected="false">Contact</button>
                        </li>
                        <li class="nav-item" role="presentation">
                          <button class="nav-link" id="disabled-tab" data-bs-toggle="tab" data-bs-target="#disabled-tab-pane" type="button" role="tab" aria-controls="disabled-tab-pane" aria-selected="false" disabled>Disabled</button>
                        </li> --}}
                      </ul>
                      <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="home-tab-pane" role="tabpanel" aria-labelledby="home-tab" tabindex="0">{{$boy[0]['description']}}</div>
                        <div class="tab-pane fade" id="profile-tab-pane" role="tabpanel" aria-labelledby="profile-tab" tabindex="0">...</div>
                        {{-- <div class="tab-pane fade" id="contact-tab-pane" role="tabpanel" aria-labelledby="contact-tab" tabindex="0">...</div>
                        <div class="tab-pane fade" id="disabled-tab-pane" role="tabpanel" aria-labelledby="disabled-tab" tabindex="0">...</div> --}}
                      </div>
                </div>
            </div>
        </div>
        <div id="sectionDiv" class="col-md-4 ,ml-2">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title textt>Event Title</h5>
                    <p class="card-text">Event title</p>
                    <p class="card-text mt-1 mb-2">Pemateri : Coach Jumadi Subur</p>
                    <a href="#" class="btn btn-primary">Lanjut</a>
                </div>
            </div>
        </div>
    </section>
    @push('scripts')
    <script>
        $(document).ready(function () {
                $('.cover').on('click', function () {
                    $(this).children().css({
                    'z-index' : 1,
                    'opacity': 1
                    });
                $(this).children().trigger('play');
                    
                });

                $('video').on('click', function () {
                    console.log('a');
                });
            });
    </script>
    @endpush
</x-dashboard-layout>