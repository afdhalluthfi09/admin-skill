<x-ladmin>
    @dump(Session('user')['tokenuath'])
    @dump($slug)
    <div class="container-fluid">
        <div class="container">
            <div class="d-flex flex-row justify-content-between mb-2">
                <a href="{{ url()->previous() }}" role="button" class="btn btn-primary btn-small">Kembali</a>
                <a href="#" role="button" class="btn btn-success btn-small btn-dowload">Download Materi</a>
            </div>
        </div>
        <div class="container-playlist-video">
            <div class="main-video-container">
                <div class="slip">

                </div>
               <h3 class="main-vid-title">Mulai Dengan List Video Anda</h3>
            </div>

            <div class="video-list-container">
                <div class="d-flex flex-row justify-content-between">
                    <button class="btn btn-success btn-sm mb-2 btn-dowload-web">Dowload Materis</button>
                    <button id="btn-upload" class="btn btn-success btn-sm mb-2 btn-dowload-web">Upload Video Materi</button>
                </div>
                @forelse ($listItem as $item)
                    <div class="list" data-playid="{{$item['contentDetails']['videoId']}}">
                    <img src="{{$item["snippet"]["thumbnails"]["high"]["url"]}}" class="list-video"/>
                    <h3 class="list-title">{{$item["snippet"]["title"]}}</h3>
                    </div>
                @empty
                    <div class="list">
                        <h3 class="list-title">Tidak ada video</h3>
                    </div>
                @endforelse
            </div>

        </div>
    </div>
    <x-modals.modal type='modal-add' judul='Upload materi Video' class="modal-lg">
        <div id="modal-content-add">
            <form id="form-upload" action="" enctype='multipart/form-data'>
                <input type="file" name="videos" id="video" />
                <button type="submit" id="btn-submit-video" class="btn btn-success btn-sm">Upload</button>
            </form>
        </div>
        <button type="button" class="btn btn-default btn-cancel" data-dismiss="modal">Batal</button>
      </x-modals.modal>
    @push('script')
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>

                let csrfToken = $('meta[name="csrf-token"]').attr('content');
                let baseUrl = "http://sekolahskillapi.test/api";
                console.log(baseUrl);


                $('.video-list-container .list').on('click', function() {
                    $('.video-list-container .list').removeClass('active');
                    $(this).addClass('active');
                    let src = $(this).find('.list-video').attr('src');
                    let title = $(this).find('.list-title').html();
                    getEmbed($(this).data('playid'));
                    $('.main-video-container .main-vid-title').html(title);
                    console.log($(this).data('playid'));
                });


                function makeAjaxRequest(mode=null, data=null){
                    if(mode == 'add'){
                        return new Promise((resolve, reject) => {
                            $.ajax({
                                url:baseUrl+'/youtube/upload',
                                type:"POST",
                                data:data,
                                dataType: 'json',
                                contentType: false,
                                processData: false,
                                beforeSend: function () {
                                    Swal.fire({
                                        title: "Please Wait !",
                                        allowOutsideClick: !1,
                                        showConfirmButton: !1,
                                        onBeforeOpen() {
                                            Swal.showLoading()
                                        },
                                        timer:5000
                                    })
                                },
                                success: (data, textStatus, jqXHR) => {
                                    if (jqXHR.status === 200) {
                                        resolve(data);
                                    } else {
                                        reject({
                                            status: jqXHR.status,
                                            response: data
                                        });
                                    }
                                },
                                error: (jqXHR, textStatus, errorThrown) => {
                                    reject({
                                        status: jqXHR.status,
                                        response: jqXHR.responseJSON || errorThrown
                                    });
                                },
                            });
                        });
                    }
                }

                async function getEmbed(playid) {
                    try {
                        let response = await $.ajax({
                            type: "POST",
                            url: "{!! route('kelas.video.player',['idplaylist' => ':playid']) !!}".replace(':playid',playid),
                            data: {
                                _token: csrfToken
                            },
                            dataType: "json"
                        });
                        $('.main-video-container .slip').html(response.data[0].player.embedHtml);
                        $('.main-video-container').find('iframe').addClass('main-video');

                        let iframe = document.querySelector('.main-video-container iframe');
                        iframe.classList.add('main-video');

                        // Tambahkan overlay untuk mencegah klik kanan pada container video
                        let videoContainer = document.querySelector('.main-video-container');
                        videoContainer.classList.add('main-video-container-with-overlay'); // Tambahkan kelas untuk posisi relatif

                        let overlay = document.createElement('div');
                        overlay.classList.add('main-video-overlay');
                        videoContainer.appendChild(overlay);

                        // Tambahkan event listener ke overlay untuk mencegah klik kanan
                        overlay.addEventListener('contextmenu', function(e) {
                            e.preventDefault();
                        });
                        console.log(response.data[0].player.embedHtml);
                    } catch (error) {
                        console.log(error);
                    }
                }

                $('#btn-upload').on('click', function() {
                    console.log('hehehe');
                    $('#modal-add').modal('show');
                });


                $('#form-upload').on('submit', function(e) {
                    e.preventDefault();
                    let formData = new FormData();
                    let formAdd =$('#form-upload');
                    let videos = formAdd.find('#video');
                    formData.append('videos',videos[0].files[0])
                    //cek apakah file sudah diisi
                    // for (const pair of formData.entries()) {
                    //     console.log(pair[0] + ': ' + pair[1]);
                    // }
                    makeAjaxRequest('add', formData).then((response) => {
                        if (response.redirect_url) {
                            window.location.href = response.redirect_url;
                        } else {
                            console.log(response);
                        }
                    })
                    .catch((error) => {
                        console.log(error);
                    })
                });

        </script>
    @endpush
</x-ladmin>
