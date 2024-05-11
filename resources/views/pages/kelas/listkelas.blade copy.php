<x-dashboard-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div id="cardList" class="p-6 text-gray-900">
                    {{-- @dd($yt->items) --}}
                    <div class="cards">
                    @foreach ($yt as $item)
                            <div class="card">
                                <div class="card__image-holder">
                                    <img class="card__image" src='{{$item['snippet']['thumbnails']['medium']['url']}}' alt="wave" />
                                </div>
                                <div class="card-title">
                                    <a href="#" class="toggle-info btn">
                                        <span class="left"></span>
                                        <span class="right"></span>
                                    </a>
                                    @if (Bantuan::get_num_of_words($item['snippet']['title']) <= 12)
                                        <h2 class="card-event-text">{{$item['snippet']['title']}}</h2>
                                        <small>Amy Fauzia</small>
                                    @else
                                        <h2 class="card-event-text">{{$item['snippet']['title']}}</h2>
                                        <small>Amy Fauzia</small>
                                    @endif
                                </div>
                                <div class="card-flap flap1">
                                    <div class="card-description">
                                        {{$item['snippet']['title']}}
                                    </div>
                                    <div class="">
                                        <div class="card-actions">
                                            <a role="button" href="{{ route('kelas.detail') }}" class="btn">Read more</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    @push('scripts')
        <script type="text/javascript">
            $(document).ready(function(){
                var zindex = 10;

                $("div.card").click(function(e){
                    e.preventDefault();

                    var isShowing = false;

                    if ($(this).hasClass("show")) {
                        isShowing = true
                    }

                    if ($("div.cards").hasClass("showing")) {
                        // a card is already in view
                        $("div.card.show")
                        .removeClass("show");

                        if (isShowing) {
                            // this card was showing - reset the grid
                            $("div.cards")
                            .removeClass("showing");
                        } else {
                            // this card isn't showing - get in with it
                            $(this)
                            .css({zIndex: zindex})
                            .addClass("show");
                        }

                        zindex++;

                    } else {
                        // no cards in view
                        $("div.cards")
                        .addClass("showing");
                        $(this)
                        .css({zIndex:zindex})
                        .addClass("show");
                        zindex++;
                    }
                });
            });
        </script>
    @endpush
</x-dashboard-layout>
