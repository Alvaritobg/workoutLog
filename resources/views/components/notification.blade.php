@props(['session'])
{{-- Módulo que muestra un mesaje de success o error a traves de la sesion --}}
@if (session('error'))
    <div class="flex w-full flex-row flex-wrap items-center py-4 px-4 md:px-5 my-4 mx-2 md:mx-5 gap-4 bg-red-100">
        <?xml version="1.0" encoding="UTF-8"?>
        <svg class="w-10 h-20 fill-red-400" xmlns="http://www.w3.org/2000/svg" id="Outline" viewBox="0 0 24 24"
            width="512" height="512">
            <path
                d="M12,0A12,12,0,1,0,24,12,12.013,12.013,0,0,0,12,0Zm0,22A10,10,0,1,1,22,12,10.011,10.011,0,0,1,12,22Z" />
            <path d="M12,5a1,1,0,0,0-1,1v8a1,1,0,0,0,2,0V6A1,1,0,0,0,12,5Z" />
            <rect x="11" y="17" width="2" height="2" rx="1" />
        </svg>
        <p class="text-lg text-red-700">{{ session('error') }}</p>
    </div>
@endif
@if (session('success'))
    <div class="flex w-full flex-row flex-wrap items-center py-4 px-4 md:px-5 my-4 mx-2 md:mx-5 gap-4 bg-emerald-100">
        <?xml version="1.0" encoding="UTF-8"?>
        <svg class="w-10 h-20 fill-emerald-400" xmlns="http://www.w3.org/2000/svg" id="Outline" viewBox="0 0 24 24"
            width="512" height="512">
            <path
                d="m17.712,6.298c.388.393.384,1.026-.01,1.414l-5.793,5.707c-.386.387-.896.58-1.407.58s-1.025-.195-1.416-.585l-2.782-2.696c-.397-.385-.407-1.018-.022-1.414.385-.397,1.018-.406,1.414-.022l2.793,2.707,5.809-5.701c.396-.387,1.027-.383,1.414.011Zm6.288-2.298v12c0,2.206-1.794,4-4,4h-2.852l-3.847,3.18c-.362.322-.825.484-1.293.484-.476,0-.955-.168-1.337-.507l-3.748-3.157h-2.923c-2.206,0-4-1.794-4-4V4C0,1.794,1.794,0,4,0h16c2.206,0,4,1.794,4,4Zm-2,0c0-1.103-.897-2-2-2H4c-1.103,0-2,.897-2,2v12c0,1.103.897,2,2,2h3.289c.236,0,.464.083.645.235l4.047,3.41,4.17-3.416c.18-.148.405-.229.638-.229h3.212c1.103,0,2-.897,2-2V4Z" />
            <rect x="11" y="17" width="2" height="2" rx="1" />
        </svg>
        <p class="text-lg text-emerald-700">{{ session('success') }}</p>
    </div>
@endif
