<div id="Email" class="tab-pane" role="tabpanel">
    <form id="email-settings-form" method="POST">
        @csrf
        <input type="hidden" name="_key" value="email_settings">

        <div class="row g-3">
            <!-- Sender Name -->
            <div class="col-md-6">
                <label class="form-label">Sender Name</label>
                <input type="text" name="sender_name" class="form-control" placeholder="Enter sender name" value="{{ $settings['email_settings']['sender_name'] ?? '' }}">
            </div>

            <!-- Sender Email -->
            <div class="col-md-6">
                <label class="form-label">Sender Email</label>
                <input type="email" name="sender_email" class="form-control" placeholder="Enter sender email" value="{{ $settings['email_settings']['sender_email'] ?? '' }}">
            </div>

            <!-- SMTP Driver -->
            <div class="col-md-6">
                <label class="form-label">SMTP Driver</label>
                <input type="text" name="smtp_driver" class="form-control" placeholder="Enter SMTP driver" value="{{ $settings['email_settings']['smtp_driver'] ?? '' }}">
            </div>

            <!-- SMTP Host -->
            <div class="col-md-6">
                <label class="form-label">SMTP Host</label>
                <input type="text" name="smtp_host" class="form-control" placeholder="Enter SMTP host" value="{{ $settings['email_settings']['smtp_host'] ?? '' }}">
            </div>

            <!-- SMTP Username -->
            <div class="col-md-6">
                <label class="form-label">SMTP Username</label>
                <input type="text" name="smtp_username" class="form-control" placeholder="Enter SMTP username" value="{{ $settings['email_settings']['smtp_username'] ?? '' }}">
            </div>

            <!-- SMTP Password -->
            <div class="col-md-6">
                <label class="form-label">SMTP Password</label>
                <input type="text" name="smtp_password" class="form-control" placeholder="Enter SMTP password" value="{{ $settings['email_settings']['smtp_password'] ?? '' }}">
            </div>

            <!-- SMTP Encryption -->
            <div class="col-md-6">
                <label class="form-label">SMTP Encryption</label>
                <input type="text" name="smtp_encryption" class="form-control" placeholder="Enter SMTP encryption" value="{{ $settings['email_settings']['smtp_encryption'] ?? '' }}">
            </div>

            <!-- SMTP Port -->
            <div class="col-md-6">
                <label class="form-label">SMTP Port</label>
                <input type="text" name="smtp_port" class="form-control" placeholder="Enter SMTP port" value="{{ $settings['email_settings']['smtp_port'] ?? '' }}">
            </div>

            <!-- Submit Button -->
            <div class="col-12 mt-3">
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
        </div>
    </form>
</div>
