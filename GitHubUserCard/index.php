<?php
/**
 * By SkiMkino
 * GitHub: https://github.com/XMSMApi
 * License: GPLv3
*/
include '../lib/func.php';

$name = $_GET['name'];
if ($name != '') {
    header('Content-Type: image/svg+xml');
    $data = json_decode(curl('https://api.github.com/users/' . $name . '?client_id=981bfe3c46b4bd37198d3a6af249ad03a7d5952a'));
    $bg = '#'.$_GET['bg_color'];
    if ($bg == '#') {
        $bg = 'white';
    }
    echo '<?xml version="1.0"?>
    <svg
 width="700"
 height="300"
 xmlns="http://www.w3.org/2000/svg"
 xmlns:xlink="http://www.w3.org/1999/xlink">
>
	<style>
	.stats {
	    font: 350 18px \'Segoe UI\', Ubuntu, Sans-Serif;
	}
	.header {
	    font: 600 30px \'Segoe UI\', Ubuntu, Sans-Serif;
	}
	.userimg {
		stroke-radius: 5px
	}
	</style>
	
	    <defs>
            <linearGradient
             id="gradient"
            >
            <stop offset="0%" stop-color="'.$bg.'" />,<stop offset="100%" stop-color="'.$bg.'" />
          </linearGradient>
        </defs>
        <rect
          data-testid="card-bg"
          x="0.5"
          y="0.5"
          rx="4.5"
          height="100%"
          stroke="#e4e2e2"
          width="100%"
          fill="url(#gradient)"
          stroke-opacity="1"
        />
        
        <g
         data-testid="card-top"
         transform="translate(80, 80)"
        >
            <g transform="translate(90, 10)">
                <text
                 x="0"
                 y="0"
                 class="header"
                 data-testid="header"
                >'.$data->name.'</text>
                <text font-size="20" font-weight="500" transform="translate(260,0)"> ('.$data->login.')</text>
            </g>
            <g transform="translate(-50, -50)">
                <defs>
                    <rect
                     id="rect"
                     x="0"
                     y="0"
                     height="120"
                     width="120"
                     rx="500"
                    />
                    <clipPath id="clip">
                        <use href="#rect" />
                    </clipPath>
                </defs>
                <image
                 x="0"
                 y="0"
                 height="120"
                 width="120"
                 xlink:href="'.$data->avatar_url.'"
                 clip-path="url(#clip)"
                />
            </g>
            <g transform="translate(100, 40)">
                <text class="stats">ID: '.$data->id.'</text>
            </g>
        </g>

        <text transform="translate(50, 155)" fill="gray">___________________________________________________________________________________</text>
        
        <g transform="translate(52, 165)">
            <g>
                <svg aria-hidden="true" height="16" viewBox="0 0 16 16" version="1.1" width="16" data-view-component="true" class="octicon octicon-repo mr-1 color-fg-muted">
                    <path fill-rule="evenodd" d="M2 2.5A2.5 2.5 0 014.5 0h8.75a.75.75 0 01.75.75v12.5a.75.75 0 01-.75.75h-2.5a.75.75 0 110-1.5h1.75v-2h-8a1 1 0 00-.714 1.7.75.75 0 01-1.072 1.05A2.495 2.495 0 012 11.5v-9zm10.5-1V9h-8c-.356 0-.694.074-1 .208V2.5a1 1 0 011-1h8zM5 12.25v3.25a.25.25 0 00.4.2l1.45-1.087a.25.25 0 01.3 0L8.6 15.7a.25.25 0 00.4-.2v-3.25a.25.25 0 00-.25-.25h-3.5a.25.25 0 00-.25.25z"></path>
                </svg>
                <text class="stats" transform="translate(17,14)">Repositories: '.$data->public_repos.'</text>
            </g>
            <g transform="translate(0, 30)">
                <svg text="muted" aria-hidden="true" height="16" viewBox="0 0 16 16" version="1.1" width="16" data-view-component="true" class="octicon octicon-people">
                    <path fill-rule="evenodd" d="M5.5 3.5a2 2 0 100 4 2 2 0 000-4zM2 5.5a3.5 3.5 0 115.898 2.549 5.507 5.507 0 013.034 4.084.75.75 0 11-1.482.235 4.001 4.001 0 00-7.9 0 .75.75 0 01-1.482-.236A5.507 5.507 0 013.102 8.05 3.49 3.49 0 012 5.5zM11 4a.75.75 0 100 1.5 1.5 1.5 0 01.666 2.844.75.75 0 00-.416.672v.352a.75.75 0 00.574.73c1.2.289 2.162 1.2 2.522 2.372a.75.75 0 101.434-.44 5.01 5.01 0 00-2.56-3.012A3 3 0 0011 4z"></path>
                </svg>
            <text class="stats" transform="translate(17,14)">Followers: '.$data->followers.'</text>
            <text class="stats" transform="translate(17,30)">Following: '.$data->following.'</text>
            </g>
            <g transform="translate(0, 110)">
                <svg t="1642733892083" class="icon" viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg" p-id="2168" width="16" height="16">
                    <path d="M607.934444 417.856853c-6.179746-6.1777-12.766768-11.746532-19.554358-16.910135l-0.01228 0.011256c-6.986111-6.719028-16.47216-10.857279-26.930349-10.857279-21.464871 0-38.864146 17.400299-38.864146 38.864146 0 9.497305 3.411703 18.196431 9.071609 24.947182l-0.001023 0c0.001023 0.001023 0.00307 0.00307 0.005117 0.004093 2.718925 3.242857 5.953595 6.03853 9.585309 8.251941 3.664459 3.021823 7.261381 5.997598 10.624988 9.361205l3.203972 3.204995c40.279379 40.229237 28.254507 109.539812-12.024871 149.820214L371.157763 796.383956c-40.278355 40.229237-105.761766 40.229237-146.042167 0l-3.229554-3.231601c-40.281425-40.278355-40.281425-105.809861 0-145.991002l75.93546-75.909877c9.742898-7.733125 15.997346-19.668968 15.997346-33.072233 0-23.312962-18.898419-42.211381-42.211381-42.211381-8.797363 0-16.963347 2.693342-23.725354 7.297197-0.021489-0.045025-0.044002-0.088004-0.066515-0.134053l-0.809435 0.757247c-2.989077 2.148943-5.691629 4.669346-8.025791 7.510044l-78.913281 73.841775c-74.178443 74.229608-74.178443 195.632609 0 269.758863l3.203972 3.202948c74.178443 74.127278 195.529255 74.127278 269.707698 0l171.829484-171.880649c74.076112-74.17435 80.357166-191.184297 6.282077-265.311575L607.934444 417.856853z" p-id="2169"></path><path d="M855.61957 165.804257l-3.203972-3.203972c-74.17742-74.178443-195.528232-74.178443-269.706675 0L410.87944 334.479911c-74.178443 74.178443-78.263481 181.296089-4.085038 255.522628l3.152806 3.104711c3.368724 3.367701 6.865361 6.54302 10.434653 9.588379 2.583848 2.885723 5.618974 5.355985 8.992815 7.309476 0.025583 0.020466 0.052189 0.041956 0.077771 0.062422l0.011256-0.010233c5.377474 3.092431 11.608386 4.870938 18.257829 4.870938 20.263509 0 36.68962-16.428158 36.68962-36.68962 0-5.719258-1.309832-11.132548-3.645017-15.95846l0 0c-4.850471-10.891048-13.930267-17.521049-20.210297-23.802102l-3.15383-3.102664c-40.278355-40.278355-24.982998-98.79612 15.295358-139.074476l171.930791-171.830507c40.179095-40.280402 105.685018-40.280402 145.965419 0l3.206018 3.152806c40.279379 40.281425 40.279379 105.838513 0 146.06775l-75.686796 75.737962c-10.296507 7.628748-16.97358 19.865443-16.97358 33.662681 0 23.12365 18.745946 41.87062 41.87062 41.87062 8.048303 0 15.563464-2.275833 21.944801-6.211469 0.048095 0.081864 0.093121 0.157589 0.141216 0.240477l1.173732-1.083681c3.616364-2.421142 6.828522-5.393847 9.529027-8.792247l79.766718-73.603345C929.798013 361.334535 929.798013 239.981676 855.61957 165.804257z" p-id="2170"></path>
                </svg>
                <text class="stats" transform="translate(17,14)" fill="#4444BB"> '.$data->html_url.'</text>
            </g>
            <g>
                <foreignObject width="400" height="115" x="180" y="-3">
                    <body xmlns="http://www.w3.org/1999/xhtml">
                        <div>'.$data->bio.'</div>
                    </body>
                </foreignObject>
            </g>
        </g>
</svg>';
} else {
    echo json_code('', 500, 'No set name');
}
?>