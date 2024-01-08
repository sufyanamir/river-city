@include('layouts.header')
<div class=" my-4">
    <div class=" bg-white w-full rounded-lg shadow-lg">
        <div class=" p-3 text-white bg-[#930027] rounded-t-lg text-xl font-semibold">
            Help
        </div>
        <div class="p-3">
            <div id="accordion-collapse" class="accordion-collapse my-3" data-accordion="collapse">
                <h2 id="accordion-collapse-heading-1" class="border-b-2">
                    <button type="button" class="flex items-center bg-[#F5F5F5] justify-between w-full p-2  text-left rounded-t-lg  focus:ring-gray-200" data-accordion-target="#accordion-collapse-body-1" aria-expanded="true" aria-controls="accordion-collapse-body-1">
                        <span>Help Lorem ipsum dolor sit amet consectetur, adipisicing elit. Dolore hic atque illum eos ut facere officia</span>
                        <svg data-accordion-icon class="w-3 h-3 rotate-180 shrink-0" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5 5 1 1 5" />
                        </svg>
                    </button>
                </h2>
                <div id="accordion-collapse-body" class="accordion-collapse-body bg-[#F5F5F5] hidden" aria-labelledby="accordion-collapse-heading-1">
                    <div class="p-5">
                        <p class="mb-2 text-gray-500 dark:text-gray-400">
                            Help Lorem ipsum dolor sit amet consectetur, adipisicing elit. Dolore hic atque illum eos ut facere officia Help Lorem ipsum dolor sit amet consectetur, adipisicing elit. Dolore hic atque illum eos ut facere officia Help Lorem ipsum dolor sit amet consectetur, adipisicing elit. Dolore hic atque illum eos ut facere officia Help Lorem ipsum dolor sit amet consectetur, adipisicing elit. Dolore hic atque illum eos ut facere officia
                            Help Lorem ipsum dolor sit amet consectetur, adipisicing elit. Dolore hic atque illum eos ut facere officia Help Lorem ipsum dolor sit amet consectetur, adipisicing elit. Dolore hic atque illum eos ut facere officia
                            Help Lorem ipsum dolor sit amet consectetur, adipisicing elit. Dolore hic atque illum eos ut facere officia Help Lorem ipsum dolor sit amet consectetur, adipisicing elit. Dolore hic atque illum eos ut facere officia
                            Help Lorem ipsum dolor sit amet consectetur, adipisicing elit. Dolore hic atque illum eos ut facere officia Help Lorem ipsum dolor sit .
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@include('layouts.footer')