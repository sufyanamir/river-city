@include('layouts.header')
<div class=" my-4">
    <h1 class=" text-2xl font-semibold mb-3">Email</h1>
    <div class=" bg-white w-full rounded-lg shadow-lg">
        <div class=" flex justify-between p-3">
            <div class=" text-xl font-semibold">
                <h4>Email Template List</h4>
            </div>
            <div>
                <a href="/addEmail">
                    <x-add-button :title="'+Add Template'" :class="''" :id="''"></x-add-button>
                </a>
            </div>
        </div>
        <div class="py-4">
            <div class=" overflow-x-auto">
                <table id="universalTable" class="display" style="width:100%">
                    <thead class="bg-[#930027] text-white text-sm">
                        <tr>
                            <th>Name</th>
                            <th>Type</th>
                            <th>Format</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody id="universalTableBody" class=" text-sm">
                        @foreach($emailTemplates as $email)
                        <tr>
                            <td>{{ $email->email_name }}</td>
                            <td>{{ $email->email_type }}</td>
                            <td>{{ $email->email_format }}</td>
                            <td>
                                <button>
                                    <img src="{{ asset('assets/icons/edit-icon.svg') }}" alt="btn">
                                </button>
                                <form action="/delete/email/{{ $email->email_id }}" method="post">
                                    @csrf
                                    <button>
                                        <img src="{{ asset('assets/icons/del-icon.svg') }}" alt="btn">
                                    </button>
                                </form>
                                <button>
                                    <img src="{{ asset('assets/icons/view-icon.svg') }}" alt="btn">
                                </button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@include('layouts.footer')