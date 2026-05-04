$this->settings["tooltip"] = 'Press "F11" to move to full screen or "Crtl+space" for "autocomplete"';    // Tooltip of field

// Information from your tables to help "autocomplete" in the construction of SQL
$this->settings["hintOptions"] = [ "tables" => [
                                        "users" => ["name", "score", "birthDate"],
                                        "countries" => ["name", "population", "size"]
                                    ]
                                  ];

