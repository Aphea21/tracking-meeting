resources/
└── views/
    ├── layouts/
    │   └── app.blade.php                 # Main layout (Navbar, Sidebar, etc.)
    │
    ├── agendas/
    │   ├── index.blade.php               # List of agendas (Dashboard view)
    │   ├── create.blade.php              # Form to add new agenda
    │   ├── edit.blade.php                # Form to edit an agenda
    │   ├── show.blade.php                # Detailed single agenda page
    │   ├── _details.blade.php            # Partial for details tab
    │   ├── _concerns.blade.php           # Partial for concerns tab
    │   ├── _attachments.blade.php        # Partial for attachments tab
    │   └── _comments.blade.php           # Partial for discussion/comments
    │
    └── components/
        └── alert.blade.php               # Optional shared component (success/error)
