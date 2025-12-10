# SATORI Studio Feature Flags

This document describes the Phase 1B feature registry and how to toggle SATORI Studio modules/extensions via filters. All features ship **enabled by default**; this registry is a safety layer for future trimming without changing behaviour today.

## Registry location
- Core helper: `\Satori_Studio\Core\Features` (`src/Core/Features.php`).
- Registry data is exposed via the `satori_studio_feature_flags` filter before use.
- Feature keys follow the pattern `module-{slug}`, `extension-{slug}`, or descriptive identifiers for core systems.

## Accessing feature data
Use the service container helper to inspect flags programmatically:

```php
$features = satori_studio_service( 'features' );
$all      = $features ? $features->get_all() : array();
```

To gate a specific toggle without pulling the entire registry, use the helper:

```php
$is_enabled = satori_studio_feature_enabled( 'ui-legacy-upgrade-promos' );
```

## Disabling a feature via filter

```php
add_filter( 'satori_studio_feature_flags', function( $flags ) {
        // Example: temporarily disable the Photo module.
        if ( isset( $flags['module-photo'] ) ) {
                $flags['module-photo']['enabled'] = false;
        }

        return $flags;
} );
```

### Guidance
- Prefer toggling **optional** or **legacy** features only; core features may be assumed elsewhere in the codebase.
- When disabling integrations (e.g., `extension-fl-builder-seo-plugins`), ensure dependent plugins or workflows are unaffected.
- No UI switches are provided in Phase 1B—filters are the only supported entry point.

### Phase 1C upsell/legacy UI flags
- `ui-legacy-upgrade-screen` — controls visibility of the legacy Upgrade tab in admin settings.
- `ui-legacy-license-screen` — controls legacy license settings visibility.
- `ui-legacy-upgrade-promos` — gates builder-side upgrade CTAs and template panel upsells.
- `ui-legacy-themer-promos` — hides/shows Themer-specific promo panels.
- `ui-legacy-assistant-promos` — hides/shows Assistant Pro promo panels.

This registry is foundational for future phases where modules may be conditionally removed or packaged separately.
