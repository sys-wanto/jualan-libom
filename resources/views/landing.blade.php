<x-front-layout>
 <!-- Hero -->
 <section class="container relative pb-[100px] pt-[30px]">
    <div class="flex flex-col items-center justify-center gap-[30px]">
      <!-- Preview Image -->
      <div class="relative">
        <div class="absolute z-0 hidden lg:block">
          <div class="font-extrabold text-[220px] text-darkGrey tracking-[-0.06em] leading-[101%]">
            <div data-aos="fade-right" data-aos-delay="300">
              NEW
            </div>
            <div data-aos="fade-left" data-aos-delay="600">
              HONDA
            </div>
          </div>
        </div>
        <img src="/images/vario.webp" class="w-full max-w-[963px] z-10 relative" alt="" data-aos="zoom-in"
             data-aos-delay="950">
      </div>

      <div class="flex flex-col lg:flex-row items-center justify-around lg:gap-[60px] gap-7">
        <!-- Car Details -->
        <div class="flex items-center gap-y-12">
          <div class="flex flex-col items-center gap-[2px] px-3 md:px-10" data-aos="fade-left" data-aos-delay="1400">
            <h6 class="font-bold text-dark text-xl md:text-[26px] text-center">
             Harga
            </h6>
            <p class="text-sm font-normal text-center md:text-base text-secondary">
              Tentukan DP mu
            </p>
          </div>
          <span class="vr" data-aos="fade-left" data-aos-delay="1600"></span>
          <div class="flex flex-col items-center gap-[2px] px-3 md:px-10" data-aos="fade-left" data-aos-delay="1900">
            <h6 class="font-bold text-dark text-xl md:text-[26px] text-center">
              Pilihan
            </h6>
            <p class="text-sm font-normal text-center md:text-base text-secondary">
              Banyak sekali
            </p>
          </div>
          <span class="vr" data-aos="fade-left" data-aos-delay="2100"></span>
          <div class="flex flex-col items-center gap-[2px] px-3 md:px-10" data-aos="fade-left" data-aos-delay="2400">
            <h6 class="font-bold text-dark text-xl md:text-[26px] text-center">
              Promo
            </h6>
            <p class="text-sm font-normal text-center md:text-base text-secondary">
              Nantikan Promo menarik
            </p>
          </div>
          <span class="vr" data-aos="fade-left" data-aos-delay="2600"></span>
          <div class="flex flex-col items-center gap-[2px] px-3 md:px-10" data-aos="fade-left" data-aos-delay="2900">
            <h6 class="font-bold text-dark text-xl md:text-[26px] text-center">
             Pengantaran
            </h6>
            <p class="text-sm font-normal text-center md:text-base text-secondary">
              Gratis Ongkir
            </p>
          </div>
        </div>
        <!-- Button Primary -->
        <div class="p-1 rounded-full bg-primary group" data-aos="zoom-in" data-aos-delay="3400">
          <a href="#RecomendHonda" class="btn-primary">
            <p class="transition-all duration-[320ms] translate-x-3 group-hover:-translate-x-1">
             Yuk Pesan sekarang
            </p>
            <img src="/svgs/ic-arrow-right.svg"
                 class="opacity-0 group-hover:opacity-100 group-hover:translate-x-1 transition-all duration-[320ms]"
                 alt="">
          </a>
        </div>
      </div>
    </div>
  </section>

  <!-- Popular Cars -->
  <section class="bg-darkGrey" id="RecomendHonda">
    <div class="container relative py-[100px]">
      <header class="mb-[30px]">
        <h2 class="font-bold text-dark text-[26px] mb-1">
          Recomend Honda
        </h2>
        <p class="text-base text-secondary">Start your big day with NEW HONDA</p>
      </header>

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

  <!-- Extra Benefits -->
  <section class="container relative pt-[100px]">
    <div class="flex items-center flex-col md:flex-row flex-wrap justify-center gap-8 lg:gap-[120px]">
      <img src="/images/Group 17.png" class="w-full lg:max-w-[536px]" alt="">
      <div class="max-w-[268px] w-full">
        <div class="flex flex-col gap-[30px]">
          <header>
            <h2 class="font-bold text-dark text-[26px] mb-1">
              Extra Benefits
            </h2>
            <p class="text-base text-secondary">You drive safety</p>
          </header>
          <!-- Benefits Item -->
          <div class="flex items-center gap-4">
            <div class="bg-dark rounded-[26px] p-[19px]">
              <img src="/svgs/ic-car.svg" alt="">
            </div>
            <div>
              <h5 class="text-lg text-dark font-bold mb-[2px]">
                Delivery
              </h5>
              <p class="text-sm font-normal text-secondary">Just sit tight and wait</p>
            </div>
          </div>
          <div class="flex items-center gap-4">
            <div class="bg-dark rounded-[26px] p-[19px]">
              <img src="/svgs/ic-card.svg" alt="">
            </div>
            <div>
              <h5 class="text-lg text-dark font-bold mb-[2px]">
               Kredit
              </h5>
              <p class="text-sm font-normal text-secondary">12x Pay Installment</p>
            </div>
          </div>
          <div class="flex items-center gap-4">
            <div class="bg-dark rounded-[26px] p-[19px]">
              <img src="/svgs/ic-securityuser.svg" alt="">
            </div>
            <div>
              <h5 class="text-lg text-dark font-bold mb-[2px]">
                Aman
              </h5>
              <p class="text-sm font-normal text-secondary">Use your plate number</p>
            </div>
          </div>
          <div class="flex items-center gap-4">
            <div class="bg-dark rounded-[26px] p-[19px]">
              <img src="/svgs/ic-convert3dcube.svg" alt="">
            </div>
            <div>
              <h5 class="text-lg text-dark font-bold mb-[2px]">
                Fast Respon for your question
              </h5>
              <p class="text-sm font-normal text-secondary">FAQ with bot</p>
            </div>
          </div>
        </div>
        <!-- CTA Button -->
        <div class="mt-[50px]">
            <!-- Button Primary -->
            <div class="p-1 rounded-full bg-primary group">
              <a href="{{ route('front.product') }}" class="btn-primary">
                <p class="transition-all duration-[320ms] translate-x-3 group-hover:-translate-x-10 text-center">
                  Cari Produk lain
                </p>
                <img src="/svgs/ic-arrow-right.svg"
                     class="transition-all duration-[320ms] opacity-0 group-hover:opacity-100 group-hover:translate-x-10"
                     alt="">
              </a>
            </div>
          </div>
        </div>
      </div>
    </section>

  <!-- FAQ -->
  <section class="container relative py-[100px]">
    <header class="text-center mb-[50px]">
      <h2 class="font-bold text-dark text-[26px] mb-1">
        Frequently Asked Questions
      </h2>
      {{-- <p class="text-base text-secondary">Learn more about Vrom and get a success</p> --}}
    </header>

    <!-- Questions -->
    <div class="grid md:grid-cols-2 gap-x-[50px] gap-y-6 max-w-[910px] w-full mx-auto">
      <a href="#!" class="px-6 py-4 border rounded-[24px] border-grey h-min accordion max-w-[430px]"
         id="faq1">
        <div class="flex items-center justify-between gap-1">
          <p class="text-base font-semibold text-dark">
            Bagaimana Nyicil dengan mudah ?
          </p>
          <img src="/svgs/ic-chevron-down-rounded.svg" class="transition-all" alt="">
        </div>
        <div class="hidden pt-4 max-w-[335px]" id="faq1-content">
          <p class="text-base text-dark leading-[26px]">
            Bekerja
          </p>
        </div>
      </a>
      <a href="#!" class="px-6 py-4 border rounded-[24px] border-grey h-min accordion max-w-[430px]"
         id="faq2">
        <div class="flex items-center justify-between gap-1">
          <p class="text-base font-semibold text-dark">
           Bagaimana Cara klaim asuransi?
          </p>
          <img src="/svgs/ic-chevron-down-rounded.svg" class="transition-all" alt="">
        </div>
        <div class="hidden pt-4 max-w-[335px]" id="faq2-content">
          <p class="text-base text-dark leading-[26px]">
            Tenang selama anda tidak menabrak orang aman aman saja
          </p>
        </div>
      </a>
      <a href="#!" class="px-6 py-4 border rounded-[24px] border-grey h-min accordion max-w-[430px]"
         id="faq3">
        <div class="flex items-center justify-between gap-1">
          <p class="text-base font-semibold text-dark">
            Bagaimana jika saya tidak bisa membayar?
          </p>
          <img src="/svgs/ic-chevron-down-rounded.svg" class="transition-all" alt="">
        </div>
        <div class="hidden pt-4 max-w-[335px]" id="faq3-content">
          <p class="text-base text-dark leading-[26px]">
            Tenang pastikan anda membayar
          </p>
        </div>
      </a>
      <a href="#!" class="px-6 py-4 border rounded-[24px] border-grey h-min accordion max-w-[430px]"
         id="faq4">
        <div class="flex items-center justify-between gap-1">
          <p class="text-base font-semibold text-dark">
            Bagaimana saya mendapatkan promo?
          </p>
          <img src="/svgs/ic-chevron-down-rounded.svg" class="transition-all" alt="">
        </div>
        <div class="hidden pt-4 max-w-[335px]" id="faq4-content">
          <p class="text-base text-dark leading-[26px]">
            Bayar cicilan tepat waktu
          </p>
        </div>
      </a>
      <a href="#!" class="px-6 py-4 border rounded-[24px] border-grey h-min accordion max-w-[430px]"
         id="faq5">
        <div class="flex items-center justify-between gap-1">
          <p class="text-base font-semibold text-dark">
            Bagaimana saya membayar dengan cash?
          </p>
          <img src="/svgs/ic-chevron-down-rounded.svg" class="transition-all" alt="">
        </div>
        <div class="hidden pt-4 max-w-[335px]" id="faq5-content">
          <p class="text-base text-dark leading-[26px]">
            Bisa menggunakan metode yang disediakan
          </p>
        </div>
      </a>
      <a href="#!" class="px-6 py-4 border rounded-[24px] border-grey h-min accordion max-w-[430px]"
         id="faq6">
        <div class="flex items-center justify-between gap-1">
          <p class="text-base font-semibold text-dark">
           Bagaimana saya mendapatkan hadiah?
          </p>
          <img src="/svgs/ic-chevron-down-rounded.svg" class="transition-all" alt="">
        </div>
        <div class="hidden pt-4 max-w-[335px]" id="faq6-content">
          <p class="text-base text-dark leading-[26px]">
           Ikuti event yang disediakan dan jangan lupa follow sosial media kami
          </p>
        </div>
      </a>
    </div>
  </section>

 <!-- Instant Booking -->
 <section class="relative bg-[#060523]">
    <div class="container py-20">
      <div class="flex flex-col">
        <header class="mb-[50px] max-w-[360px] w-full">
          <h2 class="font-bold text-white text-[26px] mb-4">
            Anda Puas <br>
            Bismillah.
          </h2>
          <p class="text-base text-subtlePars"> Booking sekarang dapatkan extra benefit lainnya </p>
        </header>
        <!-- Button Primary -->
        <div class="p-1 rounded-full bg-primary group w-max">
          <a href="#RecomendHonda" class="btn-primary">
            <p class="transition-all duration-[320ms] translate-x-3 group-hover:-translate-x-1">
              Book Now
            </p>
            <img src="/svgs/ic-arrow-right.svg"
                 class="opacity-0 group-hover:opacity-100 group-hover:translate-x-1 transition-all duration-[320ms]"
                 alt="">
          </a>
        </div>
      </div>
      <div class="absolute bottom-[-30px] right-0 lg:w-[764px] max-h-[332px] hidden lg:block">
        <img src="/images/porsche_small.webp" alt="">
      </div>
    </div>
  </section>

  <footer class="py-10 md:pt-[100px] md:pb-[70px] container">
    <p class="text-base text-center text-secondary">
      All Rights Reserved. Copyright Fadhil A Yazid
    </p>
  </footer>
</x-front-layout>
