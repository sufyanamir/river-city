@include('layouts.header')
<div class="flex items-center space-x-4">
    <!-- Edit Checkbox -->
    <div class="relative">
      <input type="checkbox" id="edit" class="hidden">
      <label for="edit" class="flex items-center cursor-pointer">
        <div class="w-5 h-5 border rounded-sm flex items-center justify-center">
          <!-- Checkmark icon when checked -->
          <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-green-500 hidden" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
            <path fill-rule="evenodd" d="M6.293 9.293a1 1 0 011.414 0L10 11.586l2.293-2.293a1 1 0 111.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z" clip-rule="evenodd"/>
          </svg>
        </div>
        <span class="ml-2">Edit</span>
      </label>
    </div>
  
    <!-- Delete Checkbox -->
    <!-- ... Similar to the above structure ... -->
  
    <!-- Add Checkbox -->
    <!-- ... Similar to the above structure ... -->
  </div>
  
  <script>
    // Optional: JavaScript/jQuery to toggle the visibility of the checkmark SVG based on checkbox state
    document.querySelectorAll('input[type="checkbox"]').forEach(checkbox => {
      checkbox.addEventListener('change', function() {
        const svg = this.nextElementSibling.querySelector('svg');
        if (this.checked) {
          svg.classList.remove('hidden');
        } else {
          svg.classList.add('hidden');
        }
      });
    });
  </script>
  @include('layouts.footer')
  