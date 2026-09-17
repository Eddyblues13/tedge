@include('user.layouts.header')

<style>
    .profile-page {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        min-height: calc(100vh - 60px);
        padding: 40px 20px;
    }

    .profile-page-photo {
        width: 130px;
        height: 130px;
        border-radius: 50%;
        object-fit: cover;
        border: 4px solid rgba(99, 102, 241, 0.25);
        box-shadow: 0 4px 24px rgba(0, 0, 0, 0.3);
    }

    .profile-page-name {
        font-size: 1.5rem;
        font-weight: 700;
        margin-top: 20px;
        margin-bottom: 8px;
        color: #fff;
    }

    .profile-page-plan {
        display: inline-block;
        padding: 6px 28px;
        border-radius: 20px;
        font-size: 0.82rem;
        font-weight: 700;
        letter-spacing: 2px;
        text-transform: uppercase;
        background: rgba(56, 182, 255, 0.08);
        color: #38b6ff;
        border: 1px solid #38b6ff;
    }
</style>

<div class="profile-page">
    <img src="{{ Auth::user()->profile_photo_url ? asset(Auth::user()->profile_photo_url) : asset('assets/img/human.png') }}"
        alt="Profile Photo" class="profile-page-photo">

    <div class="profile-page-name">
        {{ Auth::user()->first_name }} {{ Auth::user()->last_name }}
    </div>

    <span class="profile-page-plan">
        {{ $activePlanName ? $activePlanName : 'No plan yet' }}
    </span>
</div>

@include('user.layouts.footer')