Codestyle:
translations _
attributes camelCase
post names and db fields _

Apply to psr1/psr2 with the follosing exceptions:
controll structures (if, else, while .e.tc) {} on new line

Sections are new separate and not directly connected to a template (but they can!)
- A section automatically exists in both languages
- A section contains slices which themselves represent single module instances
- This means you define a section and assign it possible modules to it
- Attached modules can either be repeatable or static
- Sections have a Label and identifier
- Sections are polymorphic which means they can be assigned to any DB entity which implement a specific interface

E.g Section 'Heading' with identifier 'heading_home' has two modules: Key Visual and h1
E.g Section 'Heading' with identifier 'heading_default' has one module: h1
E.g Section 'Album' with identifier 'record' has modules: Title (fix), Track (flexible), Year (fix)

Later Sections will be assigned to templates 