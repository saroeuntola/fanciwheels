 <style>
    .loader {
      border-top-color: #3b82f6; /* blue-500 */
      animation: spin 1s linear infinite;
    }

    @keyframes spin {
      to {
        transform: rotate(360deg);
      }
    }
  </style>
<body class="bg-gray-900 text-white">
  <!-- Loader -->
<div id="pageLoader" class="fixed inset-0 z-[9999] bg-gray-900 flex items-center justify-center transition-opacity duration-500">
  <div class="relative h-20 w-20">
    <div class="loader absolute inset-0 ease-linear rounded-full border-8 border-t-8 border-gray-700 h-full w-full"></div>
    <img src="./image/PWAicon-192px.png" alt="Logo" class="absolute inset-0 m-auto h-10 w-10 object-contain" />
  </div>
</div>
  <!-- Loader Script -->
<script>
  $(window).on("load", function() {
    const $loader = $("#pageLoader");
    $loader.addClass("opacity-0");
    setTimeout(function() {
      $loader.css("display", "none");
    }, 500);
  });
</script>

</body>

