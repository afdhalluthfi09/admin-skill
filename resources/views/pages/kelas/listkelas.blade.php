<x-ladmin>
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
                <button class="btn btn-success btn-lg mb-2 btn-dowload-web">Dowload Materi</button>
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
    @push('script')
        <script>
                let csrfToken = $('meta[name="csrf-token"]').attr('content');
                $('.video-list-container .list').on('click', function() {
                    console.log('hehehe');
                    $('.video-list-container .list').removeClass('active');
                    $(this).addClass('active');
                    let src = $(this).find('.list-video').attr('src');
                    let title = $(this).find('.list-title').html();
                    getEmbed($(this).data('playid'));
                    $('.main-video-container .main-vid-title').html(title);
                    console.log($(this).data('playid'));
                });

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
                        console.log(response.data[0].player.embedHtml);
                    } catch (error) {
                        console.log(error);
                    }
                }

        </script>
    @endpush
</x-ladmin>
