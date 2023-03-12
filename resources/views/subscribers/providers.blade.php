<!-- Modal -->
<div class="modal fade" id="providersId" data-bs-backdrop="static" data-bs-keyboard="false"
                    tabindex="-1" aria-labelledby="providers" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="providers">Providers</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="{{ route('saveProviders') }}" method="post">
                                    {{ csrf_field() }}
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control" id="z" placeholder="text"
                                            name="provider">
                                        <label for="z">Provider</label>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control" id="x" placeholder="text"
                                            name="phoneNumber">
                                        <label for="x">Phone Number</label>
                                    </div>
                                    <input type="hidden" name="deleted" value=0 id="">
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-primary">Save</button>
                                        <button type="button" class="btn btn-danger"
                                            data-bs-dismiss="modal">Close</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>