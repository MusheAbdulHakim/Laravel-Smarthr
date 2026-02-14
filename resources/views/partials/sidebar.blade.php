<div class="sidebar" id="sidebar">
    <div class="sidebar-inner slimscroll">
        <div id="sidebar-menu" class="sidebar-menu">
            <nav class="greedys sidebar-horizantal">
                {{-- Horizontal menu goes here --}}
            </nav>
            {{-- Vertical menu starts here  --}}
            <ul class="sidebar-vertical">
                @foreach ($menuItems as $item)
                    @if ($item->hasSubmenu())
                        <x-menu.submenu :item="$item" />
                    @else
                        <x-menu.item :item="$item" />
                    @endif
                @endforeach
            </ul>
            {{-- Vertical Menu ends here  --}}
        </div>
    </div>
</div>
<!-- Two Col Sidebar -->
<div class="two-col-bar" id="two-col-bar">
    <div class="sidebar sidebar-twocol">
        <div class="sidebar-left slimscroll">
            <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">

            </div>
        </div>

        <div class="sidebar-right">
            <div class="tab-content" id="v-pills-tabContent">

            </div>
        </div>
    </div>
</div>
<!-- /Two Col Sidebar -->
