{{-- Contact Messages --}}
<div class="card">
    <div class="card-header bg-white">
        <div class="d-flex justify-content-between align-items-center">
            <h3 class="card-title font-weight-bold">
                All Messages
            </h3>

            <span class="badge badge-primary p-2">
                Total:
                <span id="totalMessageCount">
                    {{ $contacts->count() }}
                </span>
            </span>
        </div>
    </div>

    <div class="card-body table-responsive">
        <table class="table table-striped table-hover align-middle" id="dataTables">
            <thead class="bg-light">
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Phone</th>
                    <th>Department</th>
                    <th>Service</th>
                    <th>Date</th>
                    <th width="140">Action</th>
                </tr>
            </thead>

            <tbody id="contactTableBody">
                @forelse($contacts as $contact)
                    <tr class="contact-row"
                        data-search="{{ strtolower($contact->name . ' ' . $contact->email . ' ' . $contact->phone) }}"
                        data-department="{{ strtolower($contact->department ?? '') }}"
                        data-service="{{ strtolower($contact->service ?? '') }}"
                        data-date="{{ $contact->created_at->format('Y-m-d') }}">
                        <td>
                            {{ $loop->iteration }}
                        </td>

                        <td>
                            <div class="contact-user-info">
                                <img src="{{ asset($contact->user?->profile_picture ?? 'uploads/images/default.jpg') }}"
                                    alt="{{ $contact->name }}" class="contact-user-avatar">

                                <div class="contact-user-details">
                                    <strong>
                                        {{ $contact->name }}
                                    </strong>

                                    <small>
                                        {{ $contact->email ?? 'No Email' }}
                                    </small>
                                </div>
                            </div>
                        </td>

                        <td>
                            <span class="contact-info-badge">
                                <i class="fas fa-phone-alt"></i>
                                {{ $contact->phone }}
                            </span>
                        </td>

                        <td>
                            <span class="contact-info-badge">
                                <i class="fas fa-building"></i>
                                {{ $contact->department ?? 'N/A' }}
                            </span>
                        </td>

                        <td>
                            <span class="contact-info-badge">
                                <i class="fas fa-concierge-bell"></i>
                                {{ $contact->service ?? 'N/A' }}
                            </span>
                        </td>

                        <td>
                            <span class="contact-date">
                                <i class="far fa-calendar-alt"></i>
                                {{ $contact->created_at->format('d M Y') }}
                            </span>
                        </td>

                        <td>
                            <div class="contact-actions">
                                <a href="{{ route('contacts.show', $contact->id) }}"
                                    class="contact-action-btn contact-view-btn" title="View Message">
                                    <i class="fas fa-eye"></i>
                                    <span>View Contact</span>
                                </a>

                                <form action="{{ route('contacts.destroy', $contact->id) }}" method="POST"
                                    class="d-inline">
                                    @csrf
                                    @method('DELETE')

                                    <button type="submit" class="contact-action-btn contact-delete-btn"
                                        title="Delete Message" onclick="return confirm('Delete this message?')">
                                        <i class="fas fa-trash"></i>
                                        <span>Delete Contact</span>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center">
                            No messages found
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
