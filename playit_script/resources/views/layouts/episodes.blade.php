
<div class="card-episodes flex overflow-x-scroll h-auto px-5 my-3 ">
    @foreach($allepisodes as $episode)
        <div class="relative mr-2" style="width:249px">
            <div class="slide">
                <div class="card-wrapper">
                    <a href="{{ url($episode->series->id) }}/{{ $episode->series->slug }}/season-{{ $episode->season_id }}/episode-{{ $episode->episode_id}}">
                        <div class="card inline-top loaded portrait-card">
                            <div class="card-content-wrap ">
                                <div class="card-image-content">
                                    <div class="image-card base-card-image">
                                        <img src="{{ $episode->backdrop }}" width="320px" height="280px" alt="{{ $episode->name }}" title="{{ $episode->name }}" class="original-image">
                                    </div>
                                    <div>
                                        <div class="absolute top-1 left-1 bg-gray-900 text-blue-500 text-xs px-2 py-1 rounded h-6 leading-4">S{{ $episode->season_id }}, Ep{{ $episode->episode_id }}</div>
                                        <div class="flex absolute top-1 right-1 bg-gray-900 text-blue-500 text-xs px-2 py-1 rounded h-6 leading-4">
                                            <div><span class="iconify" data-icon="akar-icons:eye" data-inline="false" data-width="16" data-height="16"></span></div>
                                            <div class="pl-1">{{ $episode->views }}</div>
                                        </div>
                                        <div class="card-overlay show-icon"></div>
                                    </div>
                                </div>
                                <div class="card-details" style="overflow: hidden;text-overflow: ellipsis;width: 237px;">
                                    <h3 class="text-overflow card-header">{{ $episode->name }}</h3>
                                    <div class="text-overflow card-subheader"><span>Air Date :</span> {{ $episode->air_date }} </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    @endforeach
</div>

