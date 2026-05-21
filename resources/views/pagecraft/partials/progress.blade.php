<div class="team-details-area">
    <div class="team-details-skills">
        <div class="wrapper {{ $classes }}" style="{{ $widgetStyle }}">
            @foreach ($p['bars'] as $bar)
                <div class="skills">
                    <div class="skill-item">
                        <div class="donation-skill-title">
                            <h5>{{ $bar['label'] }}</h5>
                        </div>
                        <div class="skill-bar">
                            <div class="bar-inner">
                                <div class="bar progress-line" data-width="60" style="width: {{ $bar['val'] }}%;">
                                    <div class="skill-percentage">
                                        <div class="count-box counted"><span class="count-text" data-speed="3000"
                                                data-stop="{{ $bar['val'] }}">{{ $bar['val'] }}</span>%</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
