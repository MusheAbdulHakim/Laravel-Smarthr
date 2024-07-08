<div class="sidebar" id="sidebar">
    <div class="sidebar-inner slimscroll">
        <div id="sidebar-menu" class="sidebar-menu">
            <nav class="greedys sidebar-horizantal">
                {{-- Horizontal menu goes here --}}
            </nav>
            {{-- Vertical menu starts here  --}}
            {!! renderAppMenu() !!}
            {{-- Vertical Menu ends here  --}}
        </div>
    </div>
</div>
<!-- Two Col Sidebar -->
<div class="two-col-bar" id="two-col-bar">
    <div class="sidebar sidebar-twocol">
        <div class="sidebar-left slimscroll">
            <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                <a class="nav-link" id="v-pills-dashboard-tab" title="Dashboard" data-bs-toggle="pill"
                    href="#v-pills-dashboard" role="tab" aria-controls="v-pills-dashboard" aria-selected="true">
                    <span class="material-icons-outlined"> home </span>
                </a>
                <a class="nav-link" id="v-pills-apps-tab" title="Apps" data-bs-toggle="pill" href="#v-pills-apps"
                    role="tab" aria-controls="v-pills-apps" aria-selected="false">
                    <span class="material-icons-outlined"> dashboard </span>
                </a>
                <a class="nav-link" id="v-pills-employees-tab" title="Employees" data-bs-toggle="pill"
                    href="#v-pills-employees" role="tab" aria-controls="v-pills-employees" aria-selected="false">
                    <span class="material-icons-outlined"> people </span>
                </a>
                <a class="nav-link" id="v-pills-clients-tab" title="Clients" data-bs-toggle="pill"
                    href="#v-pills-clients" role="tab" aria-controls="v-pills-clients" aria-selected="false">
                    <span class="material-icons-outlined"> person </span>
                </a>
                <a class="nav-link" id="v-pills-projects-tab" title="Projects" data-bs-toggle="pill"
                    href="#v-pills-projects" role="tab" aria-controls="v-pills-projects" aria-selected="false">
                    <span class="material-icons-outlined"> topic </span>
                </a>
                <a class="nav-link" id="v-pills-leads-tab" title="Leads" data-bs-toggle="pill" href="#v-pills-leads"
                    role="tab" aria-controls="v-pills-leads" aria-selected="false">
                    <span class="material-icons-outlined"> leaderboard </span>
                </a>
                <a class="nav-link" id="v-pills-tickets-tab" title="Tickets" data-bs-toggle="pill"
                    href="#v-pills-tickets" role="tab" aria-controls="v-pills-tickets" aria-selected="false">
                    <span class="material-icons-outlined">
                        confirmation_number
                    </span>
                </a>
                <a class="nav-link" id="v-pills-sales-tab" title="Sales" data-bs-toggle="pill" href="#v-pills-sales"
                    role="tab" aria-controls="v-pills-sales" aria-selected="false">
                    <span class="material-icons-outlined"> shopping_bag </span>
                </a>
                <a class="nav-link" id="v-pills-accounting-tab" title="Accounting" data-bs-toggle="pill"
                    href="#v-pills-accounting" role="tab" aria-controls="v-pills-accounting" aria-selected="false">
                    <span class="material-icons-outlined">
                        account_balance_wallet
                    </span>
                </a>
                <a class="nav-link" id="v-pills-payroll-tab" title="Payroll" data-bs-toggle="pill"
                    href="#v-pills-payroll" role="tab" aria-controls="v-pills-payroll" aria-selected="false">
                    <span class="material-icons-outlined"> request_quote </span>
                </a>

                <a class="nav-link" id="v-pills-policies-tab" title="Policies" data-bs-toggle="pill"
                    href="#v-pills-policies" role="tab" aria-controls="v-pills-policies" aria-selected="false">
                    <span class="material-icons-outlined"> verified_user </span>
                </a>
                <a class="nav-link" id="v-pills-reports-tab" title="Reports" data-bs-toggle="pill"
                    href="#v-pills-reports" role="tab" aria-controls="v-pills-reports" aria-selected="false">
                    <span class="material-icons-outlined">
                        report_gmailerrorred
                    </span>
                </a>
                <a class="nav-link" id="v-pills-performance-tab" title="Performance" data-bs-toggle="pill"
                    href="#v-pills-performance" role="tab" aria-controls="v-pills-performance"
                    aria-selected="false">
                    <span class="material-icons-outlined"> shutter_speed </span>
                </a>
                <a class="nav-link" id="v-pills-goals-tab" title="Goals" data-bs-toggle="pill"
                    href="#v-pills-goals" role="tab" aria-controls="v-pills-goals" aria-selected="false">
                    <span class="material-icons-outlined"> track_changes </span>
                </a>
                <a class="nav-link" id="v-pills-training-tab" title="Training" data-bs-toggle="pill"
                    href="#v-pills-training" role="tab" aria-controls="v-pills-training" aria-selected="false">
                    <span class="material-icons-outlined"> checklist_rtl </span>
                </a>
                <a class="nav-link" id="v-pills-promotion-tab" title="Promotions" data-bs-toggle="pill"
                    href="#v-pills-promotion" role="tab" aria-controls="v-pills-promotion"
                    aria-selected="false">
                    <span class="material-icons-outlined"> auto_graph </span>
                </a>
                <a class="nav-link" id="v-pills-resignation-tab" title="Resignation" data-bs-toggle="pill"
                    href="#v-pills-resignation" role="tab" aria-controls="v-pills-resignation"
                    aria-selected="false">
                    <span class="material-icons-outlined">
                        do_not_disturb_alt
                    </span>
                </a>
                <a class="nav-link" id="v-pills-termination-tab" title="Termination" data-bs-toggle="pill"
                    href="#v-pills-termination" role="tab" aria-controls="v-pills-termination"
                    aria-selected="false">
                    <span class="material-icons-outlined">
                        indeterminate_check_box
                    </span>
                </a>
                <a class="nav-link" id="v-pills-assets-tab" title="Assets" data-bs-toggle="pill"
                    href="#v-pills-assets" role="tab" aria-controls="v-pills-assets" aria-selected="false">
                    <span class="material-icons-outlined"> web_asset </span>
                </a>
                <a class="nav-link" id="v-pills-jobs-tab" title="Jobs" data-bs-toggle="pill" href="#v-pills-jobs"
                    role="tab" aria-controls="v-pills-jobs" aria-selected="false">
                    <span class="material-icons-outlined"> work_outline </span>
                </a>
                <a class="nav-link" id="v-pills-knowledgebase-tab" title="Knowledgebase" data-bs-toggle="pill"
                    href="#v-pills-knowledgebase" role="tab" aria-controls="v-pills-knowledgebase"
                    aria-selected="false">
                    <span class="material-icons-outlined"> school </span>
                </a>
                <a class="nav-link" id="v-pills-activities-tab" title="Activities" data-bs-toggle="pill"
                    href="#v-pills-activities" role="tab" aria-controls="v-pills-activities"
                    aria-selected="false">
                    <span class="material-icons-outlined"> toggle_off </span>
                </a>
                <a class="nav-link" id="v-pills-users-tab" title="Users" data-bs-toggle="pill"
                    href="#v-pills-users" role="tab" aria-controls="v-pills-users" aria-selected="false">
                    <span class="material-icons-outlined"> group_add </span>
                </a>
                <a class="nav-link" id="v-pills-settings-tab" title="Settings" data-bs-toggle="pill"
                    href="#v-pills-settings" role="tab" aria-controls="v-pills-settings" aria-selected="false">
                    <span class="material-icons-outlined"> settings </span>
                </a>
                <a class="nav-link" id="v-pills-profile-tab" title="Profile" data-bs-toggle="pill"
                    href="#v-pills-profile" role="tab" aria-controls="v-pills-profile" aria-selected="false">
                    <span class="material-icons-outlined"> manage_accounts </span>
                </a>
                <a class="nav-link" id="v-pills-authentication-tab" title="Authentication" data-bs-toggle="pill"
                    href="#v-pills-authentication" role="tab" aria-controls="v-pills-authentication"
                    aria-selected="false">
                    <span class="material-icons-outlined">
                        perm_contact_calendar
                    </span>
                </a>
                <a class="nav-link" id="v-pills-errorpages-tab" title="Error Pages" data-bs-toggle="pill"
                    href="#v-pills-errorpages" role="tab" aria-controls="v-pills-errorpages"
                    aria-selected="false">
                    <span class="material-icons-outlined"> announcement </span>
                </a>
                <a class="nav-link" id="v-pills-subscriptions-tab" title="Subscriptions" data-bs-toggle="pill"
                    href="#v-pills-subscriptions" role="tab" aria-controls="v-pills-subscriptions"
                    aria-selected="false">
                    <span class="material-icons-outlined"> loyalty </span>
                </a>
                <a class="nav-link active" id="v-pills-pages-tab" title="Pages" data-bs-toggle="pill"
                    href="#v-pills-pages" role="tab" aria-controls="v-pills-pages" aria-selected="false">
                    <span class="material-icons-outlined"> layers </span>
                </a>
                <a class="nav-link" id="v-pills-forms-tab" title="Forms" data-bs-toggle="pill"
                    href="#v-pills-forms" role="tab" aria-controls="v-pills-forms" aria-selected="false">
                    <span class="material-icons-outlined"> view_day </span>
                </a>
                <a class="nav-link" id="v-pills-tables-tab" title="Tables" data-bs-toggle="pill"
                    href="#v-pills-tables" role="tab" aria-controls="v-pills-tables" aria-selected="false">
                    <span class="material-icons-outlined"> table_rows </span>
                </a>
                <a class="nav-link" id="v-pills-documentation-tab" title="Documentation" data-bs-toggle="pill"
                    href="#v-pills-documentation" role="tab" aria-controls="v-pills-documentation"
                    aria-selected="false">
                    <span class="material-icons-outlined"> description </span>
                </a>
                <a class="nav-link" id="v-pills-changelog-tab" title="Changelog" data-bs-toggle="pill"
                    href="#v-pills-changelog" role="tab" aria-controls="v-pills-changelog"
                    aria-selected="false">
                    <span class="material-icons-outlined"> sync_alt </span>
                </a>
                <a class="nav-link" id="v-pills-multilevel-tab" title="Multilevel" data-bs-toggle="pill"
                    href="#v-pills-multilevel" role="tab" aria-controls="v-pills-multilevel"
                    aria-selected="false">
                    <span class="material-icons-outlined"> library_add_check </span>
                </a>
            </div>
        </div>

        <div class="sidebar-right">
            <div class="tab-content" id="v-pills-tabContent">
                
            </div>
        </div>
    </div>
</div>
<!-- /Two Col Sidebar -->