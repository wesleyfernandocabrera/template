<x-app-layout>
    <!-- Page Title Starts -->

   @section('title', 'Home | Inusittá')

    <!-- Page Title Ends -->

    @if(session('status'))
  <div id="toast" class="fixed top-0 right-0 m-4 p-4 bg-green-500 text-white rounded shadow-lg z-50" role="alert">
    <p>{{ session('status') }}</p>
  </div>
  @endif



</x-app-layout>
