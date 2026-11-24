<?php

/* Seed-only copy of the decorative content that used to live inside the Blade
   views. Once seeded, admins manage all of it from the admin panel. */
return [
    'featured_categories' => [
        'plywood' => [
            'tag' => 'The Foundation',
            'note' => 'Strength beneath every finish',
            'variants' => ['Interior Plywood', 'Exterior Plywood', 'Marine Plywood', 'BWP Plywood', 'MR Plywood', 'BWR Plywood'],
        ],
        'doors' => [
            'tag' => 'First Impressions',
            'note' => 'Crafted to welcome',
            'variants' => ['Factory-made doors', 'Door frames', 'Matched door & frame sets'],
        ],
        'decorative-laminate' => [
            'tag' => 'Surface Stories',
            'note' => 'Colour, texture, character',
            'variants' => ['HPL', 'LPL', 'Compact Laminates', 'Acrylic Laminates', 'PVC Laminates'],
        ],
        'veneers' => [
            'tag' => 'Natural Elegance',
            'note' => 'The warmth of real timber',
            'variants' => ['Natural Veneers', 'Recon Veneers', 'Smoked Veneers', 'Dyed Veneers', 'Textured Veneers'],
        ],
        'decmore-wall-panels' => [
            'tag' => 'The Final Layer',
            'note' => 'Walls that speak',
            'variants' => ['Ready-to-use wall coverings', 'Highlighters', 'Wall art', 'Fluted panels'],
        ],
    ],

    /* Default "after application" images for the two cards on a product page.
       Admins can replace these per category from Admin → Categories. */
    'category_looks' => [
        'plywood' => [
            ['image' => '/images/company-profile/page-23-image-01.png', 'caption' => 'Warm wood ceiling and decking — plywood that carries the whole space.'],
            ['image' => '/images/company-profile/page-22-image-01.png', 'caption' => 'Fluted plywood panelling behind a counter — texture with purpose.'],
        ],
        'doors' => [
            ['image' => '/images/company-profile/page-11-image-01.png', 'caption' => 'Factory-finished doors fitted as matched door-and-frame sets.'],
            ['image' => '/images/company-profile/page-23-image-01.png', 'caption' => 'Warm wooden joinery continuing from the doorway into the room.'],
        ],
        'decorative-laminate' => [
            ['image' => '/images/company-profile/page-20-image-01.png', 'caption' => 'Herringbone laminate wall — a pattern that becomes the focal point.'],
            ['image' => '/images/company-profile/page-16-image-01.png', 'caption' => 'Laminate finishes on cabinetry and decorative wall panels.'],
        ],
        'veneers' => [
            ['image' => '/images/company-profile/page-22-image-01.png', 'caption' => 'Real timber veneer slats across a feature wall.'],
            ['image' => '/images/company-profile/page-23-image-01.png', 'caption' => 'Veneered ceilings and panelling in a warm, natural palette.'],
        ],
        'decmore-wall-panels' => [
            ['image' => '/images/company-profile/page-20-image-01.png', 'caption' => 'Chevron panelling at a studio reception desk.'],
            ['image' => '/images/company-profile/page-16-image-01.png', 'caption' => 'Decorative panels adding depth to an interior wall.'],
        ],
        '_default' => [
            ['image' => '/images/company-profile/page-23-image-01.png', 'caption' => 'Installed in a warm, wood-led interior.'],
            ['image' => '/images/company-profile/page-20-image-01.png', 'caption' => 'A textured wall application in a modern space.'],
        ],
    ],

    'featured_brands' => [
        'Greenply', 'Merino', 'Greenlam', 'Century',
        'Decmore', 'Ramco', 'VOX', 'Rehau',
    ],

    'showcase' => [
        ['src' => 'https://images.unsplash.com/photo-1618221195710-dd6b41faaea6?q=80&w=1200&auto=format&fit=crop', 'title' => 'Luxury Lounge', 'category' => 'Living Rooms'],
        ['src' => 'https://images.unsplash.com/photo-1616594039964-ae9021a400a0?q=80&w=1200&auto=format&fit=crop', 'title' => 'Serene Bedroom', 'category' => 'Bedrooms'],
        ['src' => 'https://images.unsplash.com/photo-1556911220-bff31c812dba?q=80&w=1200&auto=format&fit=crop', 'title' => "Chef's Kitchen", 'category' => 'Kitchens'],
        ['src' => 'https://images.unsplash.com/photo-1620626011761-996317b8d101?q=80&w=1200&auto=format&fit=crop', 'title' => 'Spa Bathroom', 'category' => 'Bathrooms'],
        ['src' => 'https://images.unsplash.com/photo-1617806118233-18e1de247200?q=80&w=1200&auto=format&fit=crop', 'title' => 'Dining Hall', 'category' => 'Commercial Spaces'],
        ['src' => 'https://images.unsplash.com/photo-1600607687939-ce8a6c25118c?q=80&w=1200&auto=format&fit=crop', 'title' => 'Marble Accent Wall', 'category' => 'Living Rooms'],
        ['src' => 'https://images.unsplash.com/photo-1616486338812-3dadae4b4ace?q=80&w=1200&auto=format&fit=crop', 'title' => 'Walnut Bedroom', 'category' => 'Bedrooms'],
        ['src' => 'https://images.unsplash.com/photo-1600566753086-00f18fb6b3ea?q=80&w=1200&auto=format&fit=crop', 'title' => 'Beige Living Room', 'category' => 'Living Rooms'],
        ['src' => 'https://images.unsplash.com/photo-1600121848594-d8644e57abab?q=80&w=1200&auto=format&fit=crop', 'title' => 'Retail Lounge', 'category' => 'Commercial Spaces'],
    ],

    'project_highlights' => [
        'modern-luxury-residence' => ['Walnut + marble media wall', 'Layered cove & spot lighting', 'Custom low-height seating', 'Acoustic comfort planning'],
        'contemporary-living-space' => ['Daylight-first layout', 'Oak flooring & linen palette', 'Sculptural floor lamp', 'Hidden storage wall'],
        'minimal-bedroom' => ['Upholstered bed backdrop', 'Floating side tables', 'Warm 3000K lighting', 'Floor-to-ceiling wardrobe'],
        'premium-modular-kitchen' => ['Tall storage tower', 'Quartz island counter', 'Soft-close hardware', 'Under-cabinet task lights'],
    ],

    'testimonials' => [
        ['name' => 'Rohit Sharma', 'image' => 'https://images.unsplash.com/photo-1535713875002-d1d0cf377fde?w=400&h=400&fit=crop&crop=faces', 'date' => 'Feb 2026'],
        ['name' => 'Priya Verma', 'image' => 'https://images.unsplash.com/photo-1534528741775-53994a69daeb?w=400&h=400&fit=crop&crop=faces', 'date' => 'Jan 2026'],
        ['name' => 'Amit Agarwal', 'image' => 'https://images.unsplash.com/photo-1506794778202-cad84cf45f1d?w=400&h=400&fit=crop&crop=faces', 'date' => 'Jan 2026'],
        ['name' => 'Neha Singh', 'image' => 'https://images.unsplash.com/photo-1524504388940-b1c1722653e1?w=400&h=400&fit=crop&crop=faces', 'date' => 'Dec 2025'],
        ['name' => 'Vikas Bansal', 'image' => 'https://images.unsplash.com/photo-1500648767791-00dcc994a43e?w=400&h=400&fit=crop&crop=faces', 'date' => 'Dec 2025'],
    ],

    'reels' => [
        ['title' => 'Luxury Living Room Decor', 'src' => '/Trending/reel-4-dream-home.mp4', 'caption' => null, 'overlay' => null, 'tip' => null],
        ['title' => 'Modern Pendant Lighting', 'src' => '/Trending/reel-2-japandi-style-interiors.mp4', 'caption' => 'and save', 'overlay' => null, 'tip' => null],
        ['title' => 'Modular Kitchen & Overhead Cabinets', 'src' => '/Trending/reel-3-modular-kitchen-essentials.mp4', 'caption' => null, 'overlay' => ['text' => 'Overhead Cabinets', 'position' => 'center'], 'tip' => null],
        ['title' => 'Modern Bedroom Interior', 'src' => '/Trending/reel-1-home-is-a-feeling.mp4', 'caption' => null, 'overlay' => ['text' => '2 BHK Apartment ✨', 'position' => 'top'], 'tip' => null],
        ['title' => 'Luxury Bathroom Design', 'src' => '/Trending/best-bathroom-ideas-for-every-home-video.mp4', 'caption' => null, 'overlay' => ['text' => 'APNE BATHROOM', 'position' => 'bottom'], 'tip' => null],
        ['title' => 'Bathroom Colour & Material Tips', 'src' => '/Trending/3-1715770175-bWsqG.mp4', 'caption' => null, 'overlay' => null, 'tip' => ['number' => '6', 'title' => 'For your Bathroom Colour', 'body' => 'Earthy shades work well to marry it in the space or a sanctuary steel clear of darker colours, especially brick.']],
    ],

    'stats' => [
        'about' => [
            ['value' => 24, 'suffix' => '+', 'label' => 'Projects Delivered', 'icon' => 'M21 8 12 3 3 8v8l9 5 9-5V8ZM3 8l9 5 9-5M12 13v8'],
            ['value' => 8, 'suffix' => '', 'label' => 'Trade Services', 'icon' => 'M12 3 5 7v5c0 4.5 3 8.3 7 9 4-.7 7-4.5 7-9V7l-7-4ZM9 12l2 2 4-4'],
            ['value' => 1995, 'suffix' => '', 'label' => 'Established', 'icon' => 'M8 2v4M16 2v4M3 10h18M5 4h14a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2Z'],
        ],
        'contact' => [
            ['24', '+', 'Projects Delivered'],
            ['8', '', 'Trade Services'],
            ['1995', '', 'Established'],
            ['100', '%', 'Client Satisfaction'],
        ],
    ],
];
