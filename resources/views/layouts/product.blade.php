<x-front-layout>
<!-- Motor Cycle -->
<div class="grid md:grid-cols-2 lg:grid-cols-4 gap-[29px]">
    @foreach ($items as $item)
      <!-- Card -->
      <div class="card-popular">
        <div>
          <h5 class="text-lg text-dark font-bold mb-[2px]">
            {{ $item->name }}
          </h5>
          <p class="text-sm font-normal text-secondary">
            {{ $item->type ? $item->type->name : '-' }}
          </p>
          <a href="{{ route('front.detail', $item->slug) }}" class="absolute inset-0"></a>
        </div>
        <img src="{{ $item->thumbnail }}" class="rounded-[18px] min-w-[216px] w-full h-[150px]" alt="">
        <div class="flex items-center justify-between gap-1">
          <!-- Price -->
          <p class="text-sm font-normal text-secondary">
            <span class="text-base font-bold text-primary">Rp.{{ $item->price }}</span>
          </p>
          <!-- Rating -->
          <p class="text-dark text-xs font-semibold flex items-center gap-[2px]">
            ({{ $item->star }}/5)
            <img src="/svgs/ic-star.svg" alt="">
          </p>
        </div>
      </div>
    @endforeach
  </div>
</div>
</section>
</x-front-layout>
