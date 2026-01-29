<x-app-layout>
    <x-slot name="header">Report a Traffic Violation</x-slot>
    <div class="mt-16 text-center mb-16">
        <h1 class="text-2xl sm:text-6xl text-shadow-2xl text-black">Fill up the form</h1>
    </div>

    <div class="max-w-xl mx-auto bg-white p-6 mb-10 rounded shadow">
        @if ($errors->any())
            <div class="bg-red-100 text-red-800 p-4 pb-4 rounded">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>- {{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('reports.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <!-- Violation Type -->
            <div class="mb-4">
                <label for="violation_type" class="block font-semibold">Violation Type</label>
                <select name="violation_type[]" id="violation_type" class="w-full border p-2 rounded select2" multiple>
                    @foreach ($violations as $violation)
                        <option value="{{ $violation->id }}">{{ $violation->name }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Location -->
            <div>
                <!-- Barangay -->
                <div class="mb-4">
                    <label class="block font-semibold">Barangay</label>
                    <select name="barangay_id" class="w-full border p-2 rounded text-black">
                        @foreach ($barangays as $barangay)
                            <option value="{{ $barangay->id }}">{{ $barangay->brgy_name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-4">
                    <label class="block font-semibold">Street</label>
                    <input type="text" name="street" id="street" class="w-full border p-2 rounded text-black">
                </div>
                <div class="mb-4">
                    <label class="block font-semibold">Landmark</label>
                    <input type="text" name="landmark" id="landmark" class="w-full border p-2 rounded text-black">
                </div>
            </div>

            <!-- Description -->
            <div class="mb-4">
                <label for="description" class="block font-semibold">Description</label>
                <textarea name="description" id="description" rows="4" class="w-full border p-2 rounded" required></textarea>
            </div>

            <!-- Date and Time -->
            <div class="mb-4">
                <label for="datetime" class="block font-semibold">Date & Time</label>
                <input type="datetime-local" name="datetime" id="datetime" class="w-full border p-2 rounded" value="{{ old('datetime', now()->format('Y-m-d\TH:i')) }}" required>
            </div>

            <!-- Upload Evidence -->
            <div class="mb-4">
                <label for="evidence" class="block font-semibold">Upload Evidence (Photo/Video)</label>
                <input type="file" name="evidence[]" multiple id="evidence" accept=".jpg,.jpeg,.png,.mp4,.mov,.avi" class="w-full border p-2 rounded" />
            </div>

            <div class="text-right">
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                    Submit Report
                </button>
            </div>
        </form>
    </div>
</x-app-layout>

<script>
    $(document).ready(function() {
        $('#violation_type').select2({
            placeholder: "Select violation(s)",
            allowClear: true
        });
    });
</script>