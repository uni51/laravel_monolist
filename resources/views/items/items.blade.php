@if ($items)
    <div class="row">
        @foreach ($items as $key => $item)
            <div class="item">
                <div class="col-md-3 col-sm-4 col-xs-12">
                    <div class="panel panel-default">
                        <div class="panel-heading text-center">
                            <img src="{{ $item->image_url }}" alt="" class="">
                        </div>
                        <div class="panel-body">
                            @if ($item->id)
                                <p class="item-title"><a href="{{ route('items.show', $item->id) }}">{{ $item->name }}</a></p>
                            @else
                                <p class="item-title">{{ $item->name }}</p>
                            @endif
                            <div class="buttons text-center">
                                @if (Auth::check())
                                    @include('items.want_button', ['item' => $item])
                                    @include('items.have_button', ['item' => $item])
                                @endif
                            </div>
                        </div>
                        @if (isset($item->want_count))
                            <div class="panel-footer">
                                <p class="text-center">{{ $key+1 }}位: {{ $item->want_count}} Wants</p>
                            </div>
                        @endif
                        @if (isset($item->have_count))
                            <div class="panel-footer">
                                <p class="text-center">{{ $key+1 }}位: {{ $item->have_count}} Haves</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endif