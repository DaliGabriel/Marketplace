@props(['disabled' => false])

<textarea {!! $attributes->merge(['class' => '
form-control
block
px-3
w-full
py-1.5
border-gray-300 
dark:border-gray-700 
dark:bg-gray-900 
dark:text-gray-300 
focus:border-indigo-500 
dark:focus:border-indigo-600 
focus:ring-indigo-500 
dark:focus:ring-indigo-600 
rounded-md shadow-sm']) !!}></textarea>
