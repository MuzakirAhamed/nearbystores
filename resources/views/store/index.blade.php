@extends('layouts.app')
@section('title', 'Store')

@section('content')
    <div class="m-6">
        <div class="flex justify-between items-center">
            <p>Store</p>
            <a href="{{ route('store.create') }}">
                <button type="button"
                    class="px-3 py-2 text-xs font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Create+</button>
            </a>
        </div>
        <div class="cursor-pointer" title="Logout">
            <a href="{{ route('logout') }}">
                <svg width="24px" height="24px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                    <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                    <g id="SVGRepo_iconCarrier">
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M4 4H13V9H11.5V5.5H5.5V18.5H11.5V15H13V20H4V4Z"
                            fill="#1F2328"></path>
                        <path fill-rule="evenodd" clip-rule="evenodd"
                            d="M17.1332 11.25L15.3578 9.47463L16.4184 8.41397L20.0045 12L16.4184 15.586L15.3578 14.5254L17.1332 12.75H9V11.25H17.1332Z"
                            fill="#1F2328"></path>
                    </g>
                </svg>
            </a>
        </div>
        @if (session('message'))
            <div class="p-4 mb-4 text-sm text-blue-800 rounded-lg bg-blue-50 dark:bg-gray-800 dark:text-blue-400"
                role="alert">
                <span class="font-medium">{{ session('message') }}</span>
            </div>
        @endif

        <div class="relative overflow-x-auto shadow-md sm:rounded-lg mt-5">
            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            S.No
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Store Name
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Latitude
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Longitude
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Action
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($stores as $store)
                        <tr
                            class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                            <td scope="row" class="px-6 py-4 ">
                                {{ $loop->iteration }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $store->store_name }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $store->latitude }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $store->longitude }}
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex space-x-1.5">
                                    <a href="{{ route('store.show', $store->id) }}" title="View"
                                        class="font-medium text-blue-600 dark:text-blue-500 hover:underline"><svg
                                            width="20px" height="20px" viewBox="0 0 24 24" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round">
                                            </g>
                                            <g id="SVGRepo_iconCarrier">
                                                <path
                                                    d="M9 4.45962C9.91153 4.16968 10.9104 4 12 4C16.1819 4 19.028 6.49956 20.7251 8.70433C21.575 9.80853 22 10.3606 22 12C22 13.6394 21.575 14.1915 20.7251 15.2957C19.028 17.5004 16.1819 20 12 20C7.81811 20 4.97196 17.5004 3.27489 15.2957C2.42496 14.1915 2 13.6394 2 12C2 10.3606 2.42496 9.80853 3.27489 8.70433C3.75612 8.07914 4.32973 7.43025 5 6.82137"
                                                    stroke="#1C274C" stroke-width="1.5" stroke-linecap="round"></path>
                                                <path
                                                    d="M15 12C15 13.6569 13.6569 15 12 15C10.3431 15 9 13.6569 9 12C9 10.3431 10.3431 9 12 9C13.6569 9 15 10.3431 15 12Z"
                                                    stroke="#1C274C" stroke-width="1.5"></path>
                                            </g>
                                        </svg></a>
                                    <a href="{{ route('store.edit', $store->id) }}" title="Edit"
                                        class="font-medium text-blue-600 dark:text-blue-500 hover:underline"><svg
                                            width="20px" height="20px" viewBox="0 0 24 24" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round">
                                            </g>
                                            <g id="SVGRepo_iconCarrier">
                                                <path
                                                    d="M21.2799 6.40005L11.7399 15.94C10.7899 16.89 7.96987 17.33 7.33987 16.7C6.70987 16.07 7.13987 13.25 8.08987 12.3L17.6399 2.75002C17.8754 2.49308 18.1605 2.28654 18.4781 2.14284C18.7956 1.99914 19.139 1.92124 19.4875 1.9139C19.8359 1.90657 20.1823 1.96991 20.5056 2.10012C20.8289 2.23033 21.1225 2.42473 21.3686 2.67153C21.6147 2.91833 21.8083 3.21243 21.9376 3.53609C22.0669 3.85976 22.1294 4.20626 22.1211 4.55471C22.1128 4.90316 22.0339 5.24635 21.8894 5.5635C21.7448 5.88065 21.5375 6.16524 21.2799 6.40005V6.40005Z"
                                                    stroke="#000000" stroke-width="1.5" stroke-linecap="round"
                                                    stroke-linejoin="round"></path>
                                                <path
                                                    d="M11 4H6C4.93913 4 3.92178 4.42142 3.17163 5.17157C2.42149 5.92172 2 6.93913 2 8V18C2 19.0609 2.42149 20.0783 3.17163 20.8284C3.92178 21.5786 4.93913 22 6 22H17C19.21 22 20 20.2 20 18V13"
                                                    stroke="#000000" stroke-width="1.5" stroke-linecap="round"
                                                    stroke-linejoin="round"></path>
                                            </g>
                                        </svg></a>
                                    <form action="{{ route('store.destroy', $store->id) }}" method="POST" title="Delete">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="font-medium text-blue-600 dark:text-blue-500 hover:underline"><svg
                                                width="20px" height="20px" viewBox="0 0 24 24" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                                <g id="SVGRepo_tracerCarrier" stroke-linecap="round"
                                                    stroke-linejoin="round"></g>
                                                <g id="SVGRepo_iconCarrier">
                                                    <path d="M10 12V17" stroke="#000000" stroke-width="2"
                                                        stroke-linecap="round" stroke-linejoin="round"></path>
                                                    <path d="M14 12V17" stroke="#000000" stroke-width="2"
                                                        stroke-linecap="round" stroke-linejoin="round"></path>
                                                    <path d="M4 7H20" stroke="#000000" stroke-width="2"
                                                        stroke-linecap="round" stroke-linejoin="round"></path>
                                                    <path
                                                        d="M6 10V18C6 19.6569 7.34315 21 9 21H15C16.6569 21 18 19.6569 18 18V10"
                                                        stroke="#000000" stroke-width="2" stroke-linecap="round"
                                                        stroke-linejoin="round"></path>
                                                    <path
                                                        d="M9 5C9 3.89543 9.89543 3 11 3H13C14.1046 3 15 3.89543 15 5V7H9V5Z"
                                                        stroke="#000000" stroke-width="2" stroke-linecap="round"
                                                        stroke-linejoin="round"></path>
                                                </g>
                                            </svg></button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr
                            class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                            <td colspan="5" class="px-6 py-4 text-center">No datas found</td>
                        </tr>
                    @endforelse

                </tbody>
            </table>
        </div>

    </div>
@endsection
