# SATORI Studio Core Architecture

## Plugin core class
- **Role:** Singleton bootstrap that wires the modern SATORI core while deferring runtime behaviour to the legacy `class-fl-builder-loader.php`.
- **Usage:** Instantiated via `\Satori_Studio\Core\Plugin::init( $plugin_file )` in the main plugin file; exposes the shared Environment and Services container through accessors and helper functions.
- **Lifecycle guarantees:** Created once per request. The legacy Beaver Builder loader remains responsible for its own initialisation; the Plugin wrapper does not alter that flow.

## Environment class
- **Role:** Central source of plugin metadata such as file paths, URLs, basename, version, and slug.
- **Usage:** Constructed during plugin bootstrap and typically accessed through the services container (`environment` service) or helper wrappers.
- **Lifecycle guarantees:** Values are resolved during construction and cached for the lifetime of the request; no additional calculations occur after initialisation.

## Services Container
- **Role:** Minimal dependency container that registers service factories by string ID and lazy-instantiates them on first access.
- **Usage:** Factories are registered during plugin bootstrap (e.g. `environment`). Callers fetch services via `get()` on the container or through helper wrappers.
- **Lifecycle guarantees:** Services are instantiated at most once per ID per request and then cached. Missing IDs return `null` rather than throwing exceptions.

## Global helpers
- **`satori_studio()`:** Returns the core Plugin singleton, safe to call after the main plugin has loaded.
- **`satori_studio_service( $id )`:** Fetches a service from the shared container (e.g. `environment`). Intended for use on or after `plugins_loaded`.
- **`satori_studio_env()` / `satori_studio_environment()`:** Convenience wrappers returning the Environment service when available; return `null` if the container is not yet bootstrapped.

## Future Services (forward-looking)
Planned service IDs for the container, subject to future implementation:
- `environment` — core metadata (already available).
- `assets` — script and style management.
- `templates` — shared templating utilities.
- `logger` — centralised logging/diagnostics.
- `addons` — registry for extensions and integrations.
