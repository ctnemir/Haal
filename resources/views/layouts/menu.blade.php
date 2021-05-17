<!-- Desktop sidebar -->
<template x-if="!dark">
    <aside class="flex-shrink-0 hidden w-64 overflow-y-auto bg-white dark:bg-gray-800 md:block">
        @include('layouts._menus')
    </aside>
</template>
<template x-if="dark">
    <aside class="flex-shrink-0 hidden w-64 overflow-y-auto bg-white dark:bg-gray-800 md:block">
        @include('layouts._menus')
    </aside>
</template>
