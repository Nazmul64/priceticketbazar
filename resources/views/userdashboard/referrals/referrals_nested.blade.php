@extends('userdashboard.master')
@section('content')
<div class="container">
    <h3>আমার রেফার করা ইউজার ({{ $referrals->count() }})</h3>

    <div class="table-container">
        <table class="table table-bordered mb-0">
            <thead>
                <tr>
                    <th>Serial No</th>
                    <th>নাম</th>
                    <th>ইমেইল</th>
                    <th>Referred By</th>
                    <th>Direct Referrals</th>
                    <th>Total Referrals (Nested)</th>
                    <th>Joined At</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $serial = 1;

                    function totalReferralsCount($user) {
                        $count = $user->referrals->count();
                        foreach ($user->referrals as $ref) {
                            $count += totalReferralsCount($ref);
                        }
                        return $count;
                    }

                    function renderReferrals($referrals, $level = 0, $parentName = null, &$serial) {
                        foreach ($referrals as $ref) {
                            echo '<tr>';
                            echo '<td>'.($serial++).'</td>';
                            echo '<td style="padding-left: '.($level*20).'px;">';
                            echo '<a href="#">'.$ref->name.'</a>';
                            echo '</td>';
                            echo '<td>'.$ref->email.'</td>';
                            echo '<td>'.($parentName ?? 'Self').'</td>';
                            echo '<td>'.$ref->referrals->count().'</td>'; // Direct referrals
                            echo '<td>'.totalReferralsCount($ref).'</td>'; // Nested total referrals
                            echo '<td>'.$ref->created_at->format('d M, Y').'</td>';
                            echo '</tr>';

                            if ($ref->referrals->count() > 0) {
                                renderReferrals($ref->referrals, $level + 1, $ref->name, $serial);
                            }
                        }
                    }

                    renderReferrals($referrals, 0, null, $serial);
                @endphp
            </tbody>
        </table>
    </div>
</div>
@endsection
