<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */

    'accepted'          => ':attribute harus diterima.',
    'accepted_if'       => ':attribute field harus diterima jika :other adalah :value.',
    'active_url'        => ':attribute harus berupa url yang valid.',
    'after'             => ':attribute harus berupa tanggal setelahnya :date.',
    'after_or_equal'    => ':attribute harus berupa tanggal setelah atau sama dengan :date.',
    'alpha'             => ':attribute hanya boleh berisi huruf.',
    'alpha_dash'        => ':attribute hanya boleh berisi huruf, angka, strip, dan garis bawah.',
    'alpha_num'         => ':attribute hanya boleh berisi huruf dan angka.',
    'array'             => ':attribute harus berisi sebuah array.',
    'ascii'             => ':attribute hanya boleh berisi karakter dan simbol alfanumerik byte tunggal.',
    'before'            => ':attribute harus berisi tanggal sebelum :date.',
    'before_or_equal'   => ':attribute harus berisi tanggal sebelum atau sama dengan :date.',
    'between'           => [
        'numeric' => ':attribute harus bernilai antara :min sampai :max.',
        'file'    => ':attribute harus berukuran antara :min sampai :max kilobita.',
        'string'  => ':attribute harus berisi antara :min sampai :max karakter.',
        'array'   => ':attribute harus memiliki :min sampai :max anggota.',
    ],
    'boolean'           => ':attribute harus bernilai true atau false',
    'confirmed'         => 'Konfirmasi :attribute tidak cocok.',
    'current_password'  => 'Kata sandi salah.',
    'date'              => ':attribute bukan tanggal yang valid.',
    'date_equals'       => ':attribute harus berisi tanggal yang sama dengan :date.',
    'date_format'       => ':attribute tidak cocok dengan format :format.',
    'decimal'           => ':attribute harus memiliki :desimal tempat desimal.',
    'declined'          => ':attribute harus ditolak.',
    'declined_if'       => ':attribute harus ditolak ketika :other adalah :value.',
    'different'         => ':attribute dan :other harus berbeda.',
    'digits'            => ':attribute harus :digits digits.',
    'digits_between'    => ':attribute harus antara :min dan :max digits.',
    'dimensions'        => ':attribute memilik dimensi gambar yang tidak valid.',
    'distinct'          => ':attribute memiliki nilai yang duplikat.',
    'doesnt_end_with'   => ':attribute tidak boleh diakhiri dengan salah satu dari yang berikut: :values.',
    'doesnt_start_with' => ':attribute tidak boleh dimulai dengan salah satua dari yang berikut: :values.',
    'email'             => ':attribute harus berupa alamat surel yang valid.',
    'ends_with'         => ':attribute harus diakhiri salah satu dari berikut: :values',
    'enum'              => ':attribute yang dipilih tidak valid.',
    'exists'            => ':attribute yang dipilih tidak valid.',
    'file'              => ':attribute harus berupa sebuah berkas.',
    'filled'            => ':attribute harus memiliki nilai.',
    'gt'                => [
        'numeric' => ':attribute harus bernilai lebih besar dari :value.',
        'file'    => ':attribute harus berukuran lebih besar dari :value kilobita.',
        'string'  => ':attribute harus berisi lebih besar dari :value karakter.',
        'array'   => ':attribute harus memiliki lebih dari :value anggota.',
    ],
    'gte' => [
        'numeric' => ':attribute harus bernilai lebih besar dari atau sama dengan :value.',
        'file'    => ':attribute harus berukuran lebih besar dari atau sama dengan :value kilobita.',
        'string'  => ':attribute harus berisi lebih besar dari atau sama dengan :value karakter.',
        'array'   => ':attribute harus terdiri dari :value anggota atau lebih.',
    ],
    'image'             => ':attribute harus berupa gambar.',
    'in'                => ':attribute yang dipilih tidak valid.',
    'in_array'          => ':attribute tidak ada di dalam :other.',
    'integer'           => ':attribute harus berupa bilangan bulat.',
    'ip'                => ':attribute harus berupa alamat IP yang valid.',
    'ipv4'              => ':attribute harus berupa alamat IPv4 yang valid.',
    'ipv6'              => ':attribute harus berupa alamat IPv6 yang valid.',
    'json'              => ':attribute harus berupa JSON string yang valid.',
    'lowercase'         => ':attribute harus huruf kecil.',
    'lt'                => [
        'numeric' => ':attribute harus bernilai kurang dari :value.',
        'file'    => ':attribute harus berukuran kurang dari :value kilobita.',
        'string'  => ':attribute harus berisi kurang dari :value karakter.',
        'array'   => ':attribute harus memiliki kurang dari :value anggota.',
    ],
    'lte'               => [
        'numeric' => ':attribute harus bernilai kurang dari atau sama dengan :value.',
        'file'    => ':attribute harus berukuran kurang dari atau sama dengan :value kilobita.',
        'string'  => ':attribute harus berisi kurang dari atau sama dengan :value karakter.',
        'array'   => ':attribute harus tidak lebih dari :value anggota.',
    ],
    'mac_address' => ':attribute harus berupa alamat MAC yang valid.',
    'max'               => [
        'numeric' => ':attribute maskimal bernilai :max.',
        'file'    => ':attribute maksimal berukuran :max kilobita.',
        'string'  => ':attribute maskimal berisi :max karakter.',
        'array'   => ':attribute maksimal terdiri dari :max anggota.',
    ],
    'max_digits'        => ':attribute tidak boleh lebih dari :max digits.',
    'mimes'             => ':attribute harus berupa berkas berjenis: :values.',
    'mimetypes'         => ':attribute harus berupa berkas berjenis: :values.',
    'min'               => [
        'numeric' => ':attribute minimal bernilai :min.',
        'file'    => ':attribute minimal berukuran :min kilobita.',
        'string'  => ':attribute minimal berisi :min karakter.',
        'array'   => ':attribute minimal terdiri dari :min anggota.',
    ],
    'min_digits'        => ':attribute tidak boleh kurang dari :min digits.',
    'missing'           => ':attribute harus hilang.',
    'missing_if'        => ':attribute harus hilang ketika :other adalah :value.',
    'missing_unless'    => ':attribute harus hilang kecuali :other adalah :value.',
    'missing_with'      => ':attribute harus hilang saat :values ada.',
    'missing_with_all'  => ':attribute harus hilang ketika semua :values ada.',
    'multiple_of'       => ':attribute harus merupakan kelipatan dari :value.',
    'not_in'            => ':attribute yang dipilih tidak valid.',
    'not_regex'         => ':attribute format tidak valid.',
    'numeric'           => ':attribute harus angka.',
    'password' => [
        'letters'       => ':attribute harus berisi setidaknya satu huruf.',
        'mixed'         => ':attribute harus berisi setidaknya satu huruf besar dan satu huruf kecil.',
        'numbers'       => ':attribute harus mengandung setidaknya satu angka.',
        'symbols'       => ':attribute harus berisi setidaknya satu simbol.',
        'uncompromised' => 'Yang diberikan :attribute telah muncul dalam kebocoran data. Silahkan pilih :attribute yang berbeda.',
    ],
    'present'               => ':attribute harus ada.',
    'prohibited'            => ':attribute dilarang.',
    'prohibited_if'         => ':attribute dilarang bila :other adalah :value.',
    'prohibited_unless'     => ':attribute dilarang kecuali :other ada di :values.',
    'prohibits'             => ':attribute melarang :other hadir.',
    'regex'                 => 'Format :attribute tidak valid.',
    'required'              => ':attribute wajib diisi.',
    'required_if'           => ':attribute wajib diisi bila :other adalah :value.',
    'required_unless'       => ':attribute wajib diisi kecuali :other memiliki nilai :values.',
    'required_with'         => ':attribute wajib diisi bila terdapat :values.',
    'required_with_all'     => ':attribute wajib diisi bila terdapat :values.',
    'required_without'      => ':attribute wajib diisi bila tidak terdapat :values.',
    'required_without_all'  => ':attribute wajib diisi bila sama sekali tidak terdapat :values.',
    'same'                  => ':attribute dan :other harus sama.',
    'required_if_accepted'  => ':attribute diperlukan ketika :other diterima.',
    'required_array_keys'   => ':attribut harus berisi entri untuk: :values.',
    'size'                 => [
        'numeric' => ':attribute harus berukuran :size.',
        'file'    => ':attribute harus berukuran :size kilobyte.',
        'string'  => ':attribute harus berukuran :size karakter.',
        'array'   => ':attribute harus mengandung :size anggota.',
    ],
    'starts_with'          => ':attribute harus diawali salah satu dari berikut: :values',
    'string'               => ':attribute harus berupa string.',
    'timezone'             => ':attribute harus berisi zona waktu yang valid.',
    'unique'               => ':attribute sudah ada sebelumnya.',
    'uploaded'             => ':attribute gagal diunggah.',
    'uppercase'             => ':attribute harus huruf besar.',
    'url'                   => 'Format :attribute tidak valid.',
    'ulid'                  => ':attribute harus berupa ULID yang valid.',
    'uuid'                  => ':attribute harus merupakan UUID yang valid.',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap our attribute placeholder
    | with something more reader friendly such as "E-Mail Address" instead
    | of "email". This simply helps us make our message more expressive.
    |
    */

    'attributes' => [],

];
