@include('layouts.header')
<div class=" my-4">
    <h1 class=" text-2xl font-semibold mb-3">Reports</h1>
    <div class=" bg-white w-full rounded-lg shadow-lg">
        <div class="p-3">
            <div class="text-right mb-3">
                <div class="inline-flex rounded-md shadow-sm" role="group">
                    <button type="button" class=" inline-flex items-center gap-2 px-4 py-2 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-l-lg hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-2 focus:ring-blue-700 focus:text-blue-700">
                        <span>Summary</span>
                        <svg data-accordion-icon class="w-2 h-2 rotate-180 shrink-0" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5 5 1 1 5" />
                        </svg>
                    </button>
                    <button type="button" class="inline-flex items-center gap-2 px-4 py-2 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-r-md hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-2 focus:ring-blue-700 focus:text-blue-700 ">
                        <span>Download</span>
                        <svg data-accordion-icon class="w-2 h-2 rotate-180 shrink-0" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5 5 1 1 5" />
                        </svg>
                    </button>
                </div>
            </div>
            <div class="text-right">
                <div class="inline-flex rounded-md shadow-sm" role="group">
                    <button type="button" class=" inline-flex items-center gap-2 px-4 py-2 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-l-lg hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-2 focus:ring-blue-700 focus:text-blue-700">
                        <span>Month</span>
                        <svg data-accordion-icon class="w-2 h-2 rotate-180 shrink-0" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5 5 1 1 5" />
                        </svg>
                    </button>
                    <button type="button" class="inline-flex items-center gap-2 px-4 py-2 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-r-md hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-2 focus:ring-blue-700 focus:text-blue-700 ">
                        <span>September 2023</span>
                        <svg data-accordion-icon class="w-2 h-2 rotate-180 shrink-0" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5 5 1 1 5" />
                        </svg>
                    </button>
                    <button type="button" class="inline-flex items-center gap-2 px-4 py-2 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-r-md hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-2 focus:ring-blue-700 focus:text-blue-700 ">
                        <svg data-accordion-icon class="w-2 h-2 shrink-0" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 1 1 5 5 9" />
                        </svg>
                    </button>
                    <button type="button" class="inline-flex items-center gap-2 px-4 py-2 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-r-md hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-2 focus:ring-blue-700 focus:text-blue-700 ">
                        <svg data-accordion-icon class="w-2 h-2 rotate-90 shrink-0" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5 5 1 1 5" />
                        </svg>
                    </button>
                </div>
            </div>
            <div class=" my-3">
                <div class="inline-flex rounded-md shadow-sm w-full" role="group">
                    <input type="text" id="confirm_password" class="bg-gray-50 border border-gray-300  text-sm rounded-l-lg outline-none focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="Enter Confirm Password" required>
                    <button type="button" class="inline-flex items-center gap-2 px-4 py-2 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-r-md hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-1 focus:ring-blue-500 focus:text-blue-700 ">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                            <path fill="none" d="M0 0h24v24H0z" />
                            <path d="M4 18h16v2H4zm1-4h7v2H5zm0-4h11v2H5zm0-4h11v2H5zm1-4h9v2H6z" />
                        </svg>
                    </button>
                    <button type="button" class="inline-flex items-center gap-2 px-4 py-2 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-r-md hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-1 focus:ring-blue-500 focus:text-blue-700 ">
                        <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                        </svg>
                    </button>
                </div>
            </div>
            <div class="grid grid-cols-3 gab-4">
                <div class="card px-3">
                    <div class=" rounded-t-lg p-2 card-header border bg-gray-100">
                        <h3>Sales By Source</h3>
                    </div>
                    <div class=" relative h-42 overflow-auto border rounded-b-lg">
                        <table class=" w-full text-sm">
                            <thead class=" border-b-2">
                                <tr>
                                    <th class=" text-left pl-1 py-2">Source</th>
                                    <th>#</th>
                                    <th class=" text-right pr-1 py-2">Total</th>
                                </tr>
                            </thead>
                            <tbody class=" ">
                                <tr class=" border-b">
                                    <td class=" text-left pl-1 py-2">Google</td>
                                    <td class=" text-center">15</td>
                                    <td class=" text-right pr-1 py-2">26</td>
                                </tr>
                                <tr class=" border-b">
                                    <td class=" text-left pl-1 py-2">Google</td>
                                    <td class=" text-center">15</td>
                                    <td class=" text-right pr-1 py-2">26</td>
                                </tr>
                                <tr class=" border-b">
                                    <td class=" text-left pl-1 py-2">Google</td>
                                    <td class=" text-center">15</td>
                                    <td class=" text-right pr-1 py-2">26</td>
                                </tr>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th class=" text-left pl-1 py-2"> Grand Total</th>
                                    <td class=" text-center">123</td>
                                    <td class=" text-right pr-1 py-2">202135</td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
                <div class="card px-3">
                    <div class=" rounded-t-lg p-2 card-header border bg-gray-100">
                        <h3>Sales By Source</h3>
                    </div>
                    <div class=" relative h-42 overflow-auto border rounded-b-lg">
                        <table class=" w-full text-sm">
                            <thead class=" border-b-2">
                                <tr>
                                    <th class=" text-left pl-1 py-2">Source</th>
                                    <th>#</th>
                                    <th class=" text-right pr-1 py-2">Total</th>
                                </tr>
                            </thead>
                            <tbody class=" ">
                                <tr class=" border-b">
                                    <td class=" text-left pl-1 py-2">Google</td>
                                    <td class=" text-center">15</td>
                                    <td class=" text-right pr-1 py-2">26</td>
                                </tr>
                                <tr class=" border-b">
                                    <td class=" text-left pl-1 py-2">Google</td>
                                    <td class=" text-center">15</td>
                                    <td class=" text-right pr-1 py-2">26</td>
                                </tr>
                                <tr class=" border-b">
                                    <td class=" text-left pl-1 py-2">Google</td>
                                    <td class=" text-center">15</td>
                                    <td class=" text-right pr-1 py-2">26</td>
                                </tr>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th class=" text-left pl-1 py-2"> Grand Total</th>
                                    <td class=" text-center">123</td>
                                    <td class=" text-right pr-1 py-2">202135</td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
                <div class="card px-3">
                    <div class=" rounded-t-lg p-2 card-header border bg-gray-100">
                        <h3>Sales By Source</h3>
                    </div>
                    <div class=" relative h-42 overflow-auto border rounded-b-lg">
                        <table class=" w-full text-sm">
                            <thead class=" border-b-2">
                                <tr>
                                    <th class=" text-left pl-1 py-2">Source</th>
                                    <th>#</th>
                                    <th class=" text-right pr-1 py-2">Total</th>
                                </tr>
                            </thead>
                            <tbody class=" ">
                                <tr class=" border-b">
                                    <td class=" text-left pl-1 py-2">Google</td>
                                    <td class=" text-center">15</td>
                                    <td class=" text-right pr-1 py-2">26</td>
                                </tr>
                                <tr class=" border-b">
                                    <td class=" text-left pl-1 py-2">Google</td>
                                    <td class=" text-center">15</td>
                                    <td class=" text-right pr-1 py-2">26</td>
                                </tr>
                                <tr class=" border-b">
                                    <td class=" text-left pl-1 py-2">Google</td>
                                    <td class=" text-center">15</td>
                                    <td class=" text-right pr-1 py-2">26</td>
                                </tr>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th class=" text-left pl-1 py-2"> Grand Total</th>
                                    <td class=" text-center">123</td>
                                    <td class=" text-right pr-1 py-2">202135</td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@include('layouts.footer')